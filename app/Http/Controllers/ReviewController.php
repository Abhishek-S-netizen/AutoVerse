<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;

class ReviewController extends Controller
{
    public function show($slug)
    {
        
        $car = Car::where("slug",$slug)->firstOrFail(); //404 if not found
        $carDetail = $car->carDetail;         //one-to-one relation

        // Check if there is a user logged in
        if (Auth::check()) {
            $user = Auth::user();
            $wishlist = $user->wishlist(); //Get the user's wishlist
            $wishlistID = $wishlist->pluck("car_id"); //Get the IDs of the car the user has wishlisted
            return view('car_review',compact("car","carDetail","wishlistID"));
        }
    
        return view('car_review',compact("car","carDetail"));
    }
}
