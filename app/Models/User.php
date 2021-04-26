<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets()
    {
        return $this->hasMany('App\Models\Tweet');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function tweetLikes()
    {
        return $this->hasMany('App\Models\TweetLike');
    }

    public function follows()
    {
        return $this->hasMany('App\Models\Follow');
    }
}
