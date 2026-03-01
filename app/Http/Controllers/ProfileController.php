<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;


class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $rentals = $user->rentals()->distinct()->pluck("car_id");
        $cars = Car::whereIn("id",$rentals)->get();

        return view('user_profile', compact('user','cars'));
    }
}
