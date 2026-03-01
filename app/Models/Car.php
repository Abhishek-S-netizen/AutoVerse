<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'rent_price',
        'rented',
        'slug',
        'seating',
        'bootspace',
        'exterior_dimensions',
        'fuel_type',
        'fuel_economy'
    ];

    public function carDetail()
    {
        return $this->hasOne(CarDetail::class);
    }

    public function highlight()
    {
        return $this->hasOne(CarHighlight::class);
    }

    public function wishlists() {
        return $this->hasMany(Wishlist::class);
    }

    public function car_rentals() {
        return $this->hasMany(Rental::class);
    }

    public function communityPosts()
    {
        return $this->hasMany(CommunityPosts::class);
    }
}

