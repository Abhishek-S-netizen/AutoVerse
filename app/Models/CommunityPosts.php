<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityPosts extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'post_title',
        'post',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()  
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(CommunityReply::class, 'post_id');
    }
}
