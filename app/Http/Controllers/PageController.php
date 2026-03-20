<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

use App\Models\Car;
use App\Models\Comparison;
use App\Models\User;
use App\Models\Rental;
use App\Models\CommunityController;

class PageController extends Controller
{
    public function showWelcome() {
        return view("welcome");
    }

    /********************************************************************************************** */

    public function showIndex() {
        return view("index");
    }

    /********************************************************************************************** */

    public function showAbout() {
        return view("about");
    }

    /********************************************************************************************** */

    public function showSignUp() {
        return view("login_sign_up");
    }

    /********************************************************************************************** */

    public function showLogin() {
        return view("login");
    }

    /********************************************************************************************** */

    public function showAdminLogin() {
        return view("admin_login");
    }

    /********************************************************************************************** */

    public function showUserDashboard() {
        $user = Auth::user();
        $wishlistCount = $user->wishlist()->count();
        $rentedCountCurrent = $user->rentals()->whereIn("status",["approved","active","pending"])->count();
        
        $rentedCountPast = $user->rentals()->whereIn("status",["cancelled","completed"])->count();

        return view("user_dashboard",compact("wishlistCount","rentedCountCurrent","rentedCountPast"));
    }

    /********************************************************************************************** */

    public function showAdminDashboard()
    {
        $carsWithoutHighlights = Car::doesntHave('highlight')->get(); // for Add Highlight form
        $allCars = Car::all(); // for Comparison form
        $orders = Rental::get();
        $users = User::count();
        $orderCountCurrent = Rental::whereIn("status",["active","approved","pending"])->count();
        $orderCountPast = Rental::whereIn("status",["cancelled","completed"])->count();

        return view('admin_dashboard', compact('carsWithoutHighlights', 'allCars','orders','orderCountCurrent','orderCountPast','users'));
    }

    /********************************************************************************************** */

    public function showAllReviews()
    {
        // Get all cars along with their one-to-one carDetail
        $allBrands = Car::select("brand")->distinct()->get();
        $cars = Car::with('carDetail')->paginate(6);
        return view('reviews', compact("cars","allBrands"));
    }

    /********************************************************************************************** */

    public function showAllComparisons() {

        $comparison = Comparison::get();
        $car = Car::has('highlight')->get();

        return view("all_comparisons",compact("comparison","car"));
    }

    /********************************************************************************************** */

    public function showElectricCars() {
        $cars = Car::with('carDetail')->where("fuel_type","Electric")->get();
        return view("electric_cars",compact("cars"));
    }

    /********************************************************************************************** */

    public function showCompare() {
        return view("compare_cars");
    }

    /********************************************************************************************** */

    public function showCustomComparison(Request $request) {

        $request->validate([
            "firstCar" => "required|exists:cars,id",
            "secondCar" => "required|exists:cars,id|different:firstCar"
        ]);
        
        $car_1_id = $request->firstCar;
        $car_2_id = $request->secondCar;

        $car_obj_1 = Car::findOrFail($car_1_id);
        $car_obj_2 = Car::findOrFail($car_2_id);
        return view("custom_comparison",compact("car_obj_1","car_obj_2"));
    }

    /********************************************************************************************** */

    public function showFilteredReviews(Request $request) {
        $request->validate([
            "brand" => "required|string|max:255"
        ]);

        $brandSelected = $request->brand;

        $filteredCars = Car::where("brand",$brandSelected)->get();

        return view("filter_review_brand",compact("filteredCars","brandSelected"));
    }

    /********************************************************************************************** */

    public function showAdminEditDashboard(Request $request) {
        $edit_id = $request->car_edit_id;
        $car = Car::findOrFail($edit_id);

        return view("admin_edit_details",compact("car"));
    }

    /********************************************************************************************** */

    private function wishlistData($helper) {

        if($helper == 0) { 
            $user = Auth::user();
            $car = Car::paginate(6);
            $allBrands = Car::select("brand")->distinct()->get();
            $wishlist = $user->wishlist();
            $rented = $user->rentals()->whereNotIn("status",["cancelled","completed"])->get();

            $wishlistedCars = $wishlist->pluck("car_id");
            $rentedCars = $rented->pluck("car_id");

            return compact("car","wishlistedCars","rentedCars","allBrands");
        }
        else {
            $user = Auth::user();
            $wishlist = $user->wishlist()->paginate(6);
            return compact("wishlist");
        }
    }

    public function showAllCars() {
        return view("all_cars_dashboard", $this->wishlistData(0));
    }

    public function showFilteredCars(Request $request) {
        $request->validate([
            "brand" => "required|exists:cars,brand"
        ]);

        $user = Auth::user();

        $brand = $request->brand;
        $wishlist = $user->wishlist();
        $rented = $user->rentals()->whereIn("status",["approved","active","pending"])->get();

        $wishlistedCars = $wishlist->pluck("car_id");
        $rentedCars = $rented->pluck("car_id");

        $cars = Car::where("brand",$brand)->paginate(6);
        return view("garage_filtered",compact("cars","brand","rentedCars","wishlistedCars"));
    }

    public function showWishlistedCars() {
        return view("my_wishlist", $this->wishlistData(1));
    }

    /********************************************************************************************** */

    public function showUserOrders() {
        $user = Auth::user();
        $rented = $user->rentals()->whereIn("status",["pending","approved","active"])->paginate(6);
        return view("my_orders", compact("rented"));
    }

    public function showUserPastOrders() {
        $user = Auth::user();
        $rentedPast = $user->rentals()->whereIn("status",["cancelled","completed"])->paginate(6);
        return view("my_past_orders",compact("rentedPast"));
    }

    /********************************************************************************************** */

    public function showRentPage(Request $request) {
        $request->validate ([
            "car_id_number" => "required|exists:cars,id"
        ]);

        $car_id = $request->car_id_number;
        $car = Car::findOrFail($car_id);

        return view("rent_car",compact("car"));
    }

    /********************************************************************************************** */

    public function showAllAdminOrders() {
        $rentals = Rental::whereIn("status",["approved","active","pending"])->paginate(6);
        $rentalCount = Rental::count();
        return view("admin_all_orders",compact("rentals","rentalCount"));
    }

    public function showAllAdminPastOrders() {
        $rentals = Rental::whereIn("status",["cancelled","completed"])->latest()->paginate(6);
        $rentalCount = Rental::count();
        return view("admin_past_orders",compact("rentals","rentalCount"));
    }

    /********************************************************************************************** */

    public function showAllAdminUsers() {
        $users = User::paginate(6);

        return view("admin_all_users",compact("users"));
    }

    /********************************************************************************************** */

    public function showForgotPassword() {
        return view("forgot-password");
    }

    /********************************************************************************************** */

    public function handleForgotPassword(Request $request) {
        $request->validate([
            "email" => "required|exists:users,email"
        ]);

        /*Here, Laravel generates a long string, which is the token, which is basically a value for the particular user resetting the password. Without it, anyone could reset anyone's password. It then sends the mail with the reset link which has the token as part of the URL. It stores a hashed version of the token in the 'password_reset_tokens' table*/ 
        $status = Password::sendResetLink(
            $request->only("email")
        );

        return $status === Password::RESET_LINK_SENT
        ? back()->with("status", "Reset link sent! Check your email.")
        : back()->withErrors(["email" => "Email not found"]);
    }

    /********************************************************************************************** */

    public function showResetPassword($token) {
        /*This will return the page where you need to add the new password. ["token" => $token] is passed since the token is part of the url, like this "/reset-password/{token}" -- ({token} takes the value of $token)*/
        return view("reset-password",["token" => $token]);
    }
    
    /********************************************************************************************** */

    public function handleNewPassword(Request $request) {
        /*Validate if all fields are present and okay. 'confirmed' checks for password and password_confirmation and proceeds only if they match */
        $request->validate([
            "token" => "required",
            "email" => "required|email",
            "password" => "required|min:8|confirmed"
        ]);

        // This is to reset the password
        $status = Password::reset(
            $request->only("email","password","password_confirmation","token"),

            // Callback function to reset the password
            function ($user, $password) {
                // forceFill is used to avoid mass-assignment. Usually, only fields listed in $fillable can be updated but password reset is a special case
                $user->forceFill([
                    "password" => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                // Actually writes the change into the database
                $user->save();

                // Just letting Laravel know that the password has been reset so that Laravel can log the reset
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
        ? redirect("/login")->with("success","Password reset successful!")
        : back()->withErrors(["email" => "Invalid or expired token"]);
    }

    /*********************************************************************************************** */

    public function editUserDetails() {
        $user = Auth::user();
        return view("user_edit_profile",compact("user"));
    }

    /*********************************************************************************************** */

    public function showCommunities() {
        $user = Auth::user();
        $cars = Car::paginate(6);
        $brands = Car::select("brand")->distinct()->get();
        $rentedCarsID = $user->rentals()->where("status","completed")->pluck("car_id")->unique();

        return view("user_communities",compact("user","cars","brands","rentedCarsID"));
    }
    
    /********************************************************************************************** */

    public function showRentalHistory($id) {
        $user = User::findOrFail($id);
        $rentals = $user->rentals()->latest()->get();
        return view("admin_rental_history",compact("rentals","user"));
    }

    /********************************************************************************************** */

    public function showAdminCommunities() {
        $cars = Car::paginate(6);
        $brands = Car::select("brand")->distinct()->get();
        return view("admin_all_communities",compact("cars","brands"));
    }

    public function showCommunitiesFilter(Request $request) {
        $request->validate([
            "brand" => "required|exists:cars,brand"
        ]);

        $user = Auth::user();
        $brand = $request->brand;
        $cars = Car::where("brand",$brand)->paginate(6);
        $rentedCarsID = $user->rentals()->where("status","completed")->pluck("car_id");
        return view("user_communities_filtered",compact("cars","rentedCarsID","brand"));
    }
}

