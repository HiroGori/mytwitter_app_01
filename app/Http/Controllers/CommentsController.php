<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Auth;
use Validator;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'tweet_id' => 'required|exists:tweets,id',
            'body' => 'required|max:2000',
        ]);
        $params['user_id'] = Auth::id();
        $tweet = Tweet::findOrFail($params['tweet_id']);
        $tweet->comments()->create($params);

        return redirect()->route('tweets.show', ['tweet' => $tweet]);
    }
}
