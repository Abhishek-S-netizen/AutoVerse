<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;

class RentalController extends Controller
{
    public function showUserInvoice(Rental $rental) {
        $user = Auth::user();

        if ($rental->user_id != $user->id) {
            abort(403, "Unauthorized access");
        }

        return view("/invoice/{rental}", compact("rental"));
    }
}
