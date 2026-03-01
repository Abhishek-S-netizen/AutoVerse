<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    protected $fillable = [
        'car_1_id',
        'car_2_id',
        'name',
        'slug',
    ];

    public function car1()
    {
        return $this->belongsTo(Car::class, 'car_1_id');
    }

    public function car2()
    {
        return $this->belongsTo(Car::class, 'car_2_id');
    }
}
