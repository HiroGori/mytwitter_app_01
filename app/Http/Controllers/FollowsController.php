<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Auth;
use Validator;

class FollowsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $params['follower_id'] = Auth::id();
        $user = User::findOrFail($params['user_id']);
        $user->follows()->create($params);
        return redirect()->route('top');
    }
}
