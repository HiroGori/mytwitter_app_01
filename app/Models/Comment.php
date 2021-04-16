<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'tweet_id',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tweet()
    {
        return $this->belongsTo('App\Models\Tweet');
    }
}
