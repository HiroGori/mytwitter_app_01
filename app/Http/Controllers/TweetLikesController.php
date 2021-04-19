<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Auth;
use Validator;

class TweetLikesController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'tweet_id' => 'required|exists:tweets,id',
        ]);
        $params['user_id'] = Auth::id();
        $tweet = Tweet::findOrFail($params['tweet_id']);
        $tweet->tweetLikes()->create($params);
        return redirect()->route('tweets.show', ['tweet' => $tweet]);
    }
}
