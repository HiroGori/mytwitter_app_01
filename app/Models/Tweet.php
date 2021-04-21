<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table = 'tweets';

    protected $fillable = [
        'user_id',
        'body',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function tweetLikes()
    {
        return $this->hasMany('App\Models\TweetLike');
    }
}
