<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $fillable = [
        'tweet_id',
        'name',
        'type',
        'size',
    ];

    public function tweet()
    {
        return $this->belongsTo('App\Models\Tweet');
    }
}
