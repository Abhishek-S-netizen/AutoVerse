<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarDetail extends Model
{
    protected $fillable = [
        'car_id',
        'title',
        'rating',
        'hero_image',
        'intro_text',
        'interior_image',
        'interior_text',
        'drive_image',
        'drive_text',
        'safety_text'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

