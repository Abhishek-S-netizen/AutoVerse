<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Car;
use App\Models\CarDetail;
use App\Models\CarHighlight;
use App\Models\Comparison;
use App\Models\Rental;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    //Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Invalid admin credentials');
        }

        $adminName = $admin->name;

        // Store admin session
        session([
            "admin_id" => $admin->id,
        ]);
        
        return redirect('/admin');
    }

    /******************************************************************************************* */

    public function storeReview(Request $request)
    {
        // Validation
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rent' => 'required|integer|min:0',
            'year' => 'required|integer|min:0',
            'seating' => 'required|integer|min:0',
            'bootspace' => 'required|string|max:255',
            'ext_dimen' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'fuel_economy' => 'required|string|max:255',

            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',

            'hero_image' => 'required|image|mimes:jpg,jpeg,png,avif|max:5120',
            'intro_text' => 'required|string',

            'interior_image' => 'required|image|mimes:jpg,jpeg,png,avif|max:5120',
            'interior_text' => 'required|string',

            'drive_image' => 'required|image|mimes:jpg,jpeg,png,avif|max:5120',
            'drive_text' => 'required|string',

            'safety_text' => 'required|string',
        ]);

        // Prepare folder name
        $brand = trim($request->brand);
        $model = trim($request->model);

        $slug = Str::slug($brand . '-' . $model);

        // Create or get Car
        $car = Car::firstOrCreate(
            ['slug' => $slug],
            [
                'brand' => $brand,
                'model' => $model,
                'year' => $request->year,
                'rent_price' => $request->rent,
                'rented' => false,
                'slug' => $slug,
                'seating' => $request->seating,
                'bootspace' => $request->bootspace,
                'exterior_dimensions' => $request->ext_dimen,
                'fuel_type' => $request->fuel_type,
                'fuel_economy' => $request->fuel_economy
            ]
        );

        $folderName = "car_" . $car->id;
        $folderPath = storage_path("app/public/images/reviews/$folderName");

        if(!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $hero_image_name = "hero_" . time() . "." . $request->hero_image->extension();
        $request->hero_image->move($folderPath,$hero_image_name);

        $interior_image_name = "interior_" . time() . "." . $request->interior_image->extension();
        $request->interior_image->move($folderPath,$interior_image_name);

        $drive_image_name = "drive_" . time() . "." . $request->drive_image->extension();
        $request->drive_image->move($folderPath,$drive_image_name);


        // Save Car Details
        CarDetail::create([
            'car_id' => $car->id,
            'title' => $request->title,
            'rating' => $request->rating,

            'hero_image' => "storage/images/reviews/$folderName/$hero_image_name",
            'intro_text' => $request->intro_text,

            'interior_image' => "storage/images/reviews/$folderName/$interior_image_name",
            'interior_text' => $request->interior_text,

            'drive_image' => "storage/images/reviews/$folderName/$drive_image_name",
            'drive_text' => $request->drive_text,

            'safety_text' => $request->safety_text,
        ]);

        return redirect()->back()->with('success', 'Car review posted successfully!');
    } 

    /******************************************************************************************* */

    public function storeHighlight(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id|unique:car_highlights,car_id',
            'pro_1' => 'required|string|max:255',
            'pro_2' => 'required|string|max:255',
            'pro_3' => 'required|string|max:255',
            'con_1' => 'required|string|max:255',
            'con_2' => 'required|string|max:255',
            'con_3' => 'required|string|max:255',
            'feature_1' => 'required|string|max:255',
            'feature_2' => 'required|string|max:255',
            'feature_3' => 'required|string|max:255',
            'feature_4' => 'required|string|max:255',
            'feature_5' => 'required|string|max:255',
            'feature_6' => 'required|string|max:255',
            'feature_7' => 'required|string|max:255',
            'feature_8' => 'required|string|max:255',
            'feature_9' => 'required|string|max:255',
            'feature_10' => 'required|string|max:255',
            'best_for' => 'required|string|max:255',
            'key_features' => 'required|string',
            'highlight_image' => 'nullable|image|mimes:jpg,jpeg,png,avif|max:5120',
        ]);

        $car = Car::find($request->car_id);

        $imagePath = null;

        if ($request->hasFile('highlight_image')) {
            $image = $request->file('highlight_image');

            // Use the same folder structure as reviews
            $folderName = "car_" . $car->id;
            $folderPath = storage_path("app/public/images/reviews/$folderName");

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $imageName = 'highlight_' . time() . '.' . $image->extension();
            $image->move($folderPath, $imageName);
            $imagePath = "storage/images/reviews/$folderName/$imageName";
        }

        CarHighlight::create([
            'car_id' => $request->car_id,
            'pro_1' => $request->pro_1,
            'pro_2' => $request->pro_2,
            'pro_3' => $request->pro_3,
            'con_1' => $request->con_1,
            'con_2' => $request->con_2,
            'con_3' => $request->con_3,
            'feature_1' => $request->feature_1,
            'feature_2' => $request->feature_2,
            'feature_3' => $request->feature_3,
            'feature_4' => $request->feature_4,
            'feature_5' => $request->feature_5,
            'feature_6' => $request->feature_6,
            'feature_7' => $request->feature_7,
            'feature_8' => $request->feature_8,
            'feature_9' => $request->feature_9,
            'feature_10' => $request->feature_10,
            'best_for' => $request->best_for,
            'key_features' => $request->key_features,
            'image_path' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Highlight added successfully!');
    }

    /******************************************************************************************* */

    public function storeComparison(Request $request) 
    {
        $request->validate([
            'car_1_id' => 'required|exists:cars,id|different:car_2_id',
            'car_2_id' => 'required|exists:cars,id',
            'name' => 'nullable|string|max:255',
        ]);

        $carIDs = [$request->car_1_id,$request->car_2_id];
        sort($carIDs);

        $car1 = Car::find($carIDs[0]);
        $car2 = Car::find($carIDs[1]);

        $slug = Str::slug($car1->brand . '-' . $car1->model . '-vs-' . $car2->brand . '-' . $car2->model);

        Comparison::create([
            'car_1_id' => $carIDs[0],
            'car_2_id' => $carIDs[1],
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->back()->with('success', 'Comparison added successfully!');
    }

    /******************************************************************************************* */

    public function logout(Request $request) {
        $request->session()->forget('admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin-login');
    }

    /******************************************************************************************* */

    public function editReview(Request $request) {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rent' => 'required|integer|min:0',
            'year' => 'required|integer|min:0',
            'seating' => 'required|integer|min:0',
            'bootspace' => 'required|string|max:255',
            'ext_dimen' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'fuel_economy' => 'required|string|max:255',

            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',

            'intro_text' => 'required|string',

            'interior_text' => 'required|string',

            'drive_text' => 'required|string',

            'safety_text' => 'required|string',
        ]);

        $brand = trim($request->brand);
        $model = trim($request->model);

        $slug = Str::slug($brand . '-' . $model);

        $car = Car::findOrFail($request->id_number);

        $folderName = "car_" . $car->id;
        $folderPath = storage_path("app/public/images/reviews/$folderName");

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $car->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'slug' => $slug,
            'year' => $request->year,
            'rent_price' => $request->rent,
            'seating' => $request->seating,
            'bootspace' => $request->bootspace,
            'exterior_dimensions' => $request->ext_dimen,
            'fuel_type' => $request->fuel_type,
            'fuel_economy' => $request->fuel_economy,
        ]);

        $car->carDetail()->update([
            'title' => $request->title,
            'rating' => $request->rating,
            'intro_text' => $request->intro_text,
            'interior_text' => $request->interior_text,
            'drive_text' => $request->drive_text,
            'safety_text' => $request->safety_text,
        ]);

        return redirect()->back()->with('success', 'Car review updated successfully!');
    }

    /******************************************************************************************* */

    public function editHighlight(Request $request) {
        $request->validate([
            'pro_1' => 'required|string|max:255',
            'pro_2' => 'required|string|max:255',
            'pro_3' => 'required|string|max:255',
            'con_1' => 'required|string|max:255',
            'con_2' => 'required|string|max:255',
            'con_3' => 'required|string|max:255',
            'feature_1' => 'required|string|max:255',
            'feature_2' => 'required|string|max:255',
            'feature_3' => 'required|string|max:255',
            'feature_4' => 'required|string|max:255',
            'feature_5' => 'required|string|max:255',
            'feature_6' => 'required|string|max:255',
            'feature_7' => 'required|string|max:255',
            'feature_8' => 'required|string|max:255',
            'feature_9' => 'required|string|max:255',
            'feature_10' => 'required|string|max:255',
            'best_for' => 'required|string|max:255',
            'key_features' => 'required|string',
        ]);

        $car = Car::findOrFail($request->id_number_highlight);

        $car->highlight()->update([
            'pro_1' => $request->pro_1,
            'pro_2' => $request->pro_2,
            'pro_3' => $request->pro_3,
            'con_1' => $request->con_1,
            'con_2' => $request->con_2,
            'con_3' => $request->con_3,
            'feature_1' => $request->feature_1,
            'feature_2' => $request->feature_2,
            'feature_3' => $request->feature_3,
            'feature_4' => $request->feature_4,
            'feature_5' => $request->feature_5,
            'feature_6' => $request->feature_6,
            'feature_7' => $request->feature_7,
            'feature_8' => $request->feature_8,
            'feature_9' => $request->feature_9,
            'feature_10' => $request->feature_10,
            'best_for' => $request->best_for,
            'key_features' => $request->key_features,
        ]);
        return redirect()->back()->with('success', 'Highlight updated successfully!');
    }

    public function deleteDetails(Request $request) {
        $request->validate ([
            "car_delete_id" => "required|exists:cars,id"
        ]);

        $car = Car::findOrFail($request->car_delete_id);

        $folderName = "car_" . $car->id;
        $path = storage_path("app/public/images/reviews/$folderName");

        if(File::exists($path)) {
            File::deleteDirectory($path);
        }

        $car->delete();

        return redirect()->back()->with("success","Car deleted successfully");
    }

    public function markApproved(Request $request) {
        $request->validate([
            "rental_id_number" => "required|exists:rentals,id"
        ]);

        $rental = Rental::findOrFail($request->rental_id_number);
        
        if ($rental->status != "pending") {
            return back()->with("error","Only pending rentals can be approved");
        }
        
        $rental->status = "approved";
        $rental->save();

        return redirect()->back()->with("success", "Status set to approved");
    }

    public function markActive(Request $request) {
        $request->validate([
            "rental_id_number" => "required|exists:rentals,id"
        ]);

        $rental = Rental::findOrFail($request->rental_id_number);
        
        if ($rental->status != "approved") {
            return back()->with("error","Only approved rentals can be made active");
        }
        
        $rental->status = "active";
        $rental->save();

        return redirect()->back()->with("success", "Status set to active");
    }

    public function markCompleted(Request $request) {
        $request->validate([
            "rental_id_number" => "required|exists:rentals,id"
        ]);

        $rental = Rental::findOrFail($request->rental_id_number);
        
        if ($rental->status != "active") {
            return back()->with("error","Only active rentals can be completed");
        }
        
        $rental->status = "completed";
        $rental->save();

        return redirect()->back()->with("success", "Status set to completed");
    }

    public function removeAdminUser(Request $request) {
        $request->validate([
            "user_id_number" => "required|exists:users,id"
        ]);

        $user = User::findOrFail($request->user_id_number);

        $user->delete();

        return redirect()->back()->with("success", "User removed successfully");
    }

    public function registerAdmin(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "password" => "required|string|min:8|confirmed"
        ]);

        $admin = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return redirect("/");
    }
}
