<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Registration
    public function register(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users",
            "password" => "required|string|min:8|confirmed"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/user');
    }

    /********************************************************************************************** */
    //Login
    public function login(Request $request) {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended("/user");
        }

        return back()->withErrors([
            "email" => "Invalid Credentials"
        ]);
    }

    /********************************************************************************************** */

    public function addCarWishlist(Request $request) {
        $request->validate([
            "car_id_number" => "required|exists:cars,id"
        ]);

        $user = Auth::user();

        Wishlist::create([
            "user_id" => $user->id,
            "car_id" => $request->car_id_number
        ]);

        return redirect()->back()->with("success","Car added to wishlist!");
    }

    public function removeCarWishlist(Request $request) {
        $request->validate([
            "car_id_number" => "required|exists:cars,id"
        ]);

        $user = Auth::user();

        $wishlist = Wishlist::where("user_id",$user->id)->where("car_id",$request->car_id_number);

        $wishlist->delete();

        return redirect()->back()->with("success","Car removed from wishlist");
    }
    
    public function returnUserCar(Request $request) {
        $request->validate([
            "rental_id_number" => "required|exists:rentals,id"
        ]);

        $rental = Rental::findOrFail($request->rental_id_number);
        $user = Auth::user();

        if ($user->id != $rental->user_id) {
            abort(403, "Unauthorized access");
        }

        $rental->status = "cancelled";
        $rental->save();
        return redirect()->back()->with("success","Car order cancelled");
    }

    public function userRentVehicle(Request $request) {
        $request->validate([
            "car_id_rent" => "required|exists:cars,id",
            "start_date" => "required|date|after_or_equal:today",
            "end_date" => "required|date|after:start_date",
            "delivery_location" => "required|string|max:255"
        ]);

        $user = Auth::user();

        // We need to calculate the total price

        $car = Car::findOrFail($request->car_id_rent);
        $startDate = Carbon::parse($request->start_date);
        $endDate= Carbon::parse($request->end_date);
        $durationDays = $startDate->diffInDays($endDate);

        $alreadyRented = Rental::where("car_id", $request->car_id_rent)->whereIn("status",["pending","approved","active"])
        ->where(function($query) use ($startDate, $endDate) {
            $query->where("start_date", "<=", $endDate)->where("end_date", ">=", $startDate);
        })->exists();

        if ($alreadyRented) {
            return redirect()->back()->with("error","Sorry, this car has already been booked during these dates");
        }

        $totalPrice = $durationDays * $car->rent_price;

        $rental = Rental::create([
            "user_id" => $user->id,
            "car_id" => $request->car_id_rent,
            "start_date" => $startDate,
            "end_date" => $endDate,
            "delivery_location" => $request->delivery_location,
            "total_price" => $totalPrice,
            "status" => "pending"
        ]);

        return redirect("/my-orders");
    }

    public function showUserInvoice(Rental $rental) {
        $user = Auth::user();
        
        if ($user->id != $rental->user_id) {
            abort(403, "Unauthorized access");
        }

        return view("user_invoice", compact("rental"));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }

    public function updateUserDetails(Request $request) {
        $request->validate([
            "email" => "required|email",
            "name" => "required|max:255"
        ]);

        $user = Auth::user();
        $user->update([
            "email" => $request->email,
            "name" => $request->name
        ]);

        return redirect("/user")->with("success","Details updated successfully");
    }

    public function deleteUser(Request $request) {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect("/");
    }
}
