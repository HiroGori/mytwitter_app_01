<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetLike extends Model
{
    protected $fillable = [
        'tweet_id',
        'user_id',
    ];

    public function tweet()
    {
        return $this->belongsTo('App\Models\Tweet');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
