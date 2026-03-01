<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarHighlight extends Model
{
    protected $fillable = [
        'car_id',
        'pro_1', 'pro_2', 'pro_3',
        'con_1', 'con_2', 'con_3',
        'feature_1','feature_2','feature_3','feature_4','feature_5',
        'feature_6','feature_7','feature_8','feature_9','feature_10',
        'best_for',
        'key_features',
        'image_path',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
