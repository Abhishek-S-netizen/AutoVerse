<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Comparison;

class ComparisonController extends Controller
{
    public function show($slug)
    {
        $comparison = Comparison::where("slug",$slug)->firstOrFail(); //404 if not found
        $carOne = $comparison->car1;
        $carTwo = $comparison->car2;
    
        return view('compare_cars',compact("comparison","carOne","carTwo"));
    }
}
