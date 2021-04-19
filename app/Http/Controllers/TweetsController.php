<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Auth;
use Validator;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::with(['comments'])->orderBy('created_at', 'desc')->paginate(10);
        return view('tweets.index', ['tweets' => $tweets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'body' => 'required|max:144',
            'image' => 'image',
        ]);
        $params['user_id'] = Auth::id();
/*
        $message = [
            'user_id.unsignedBigInteger' => 'System Error',
            'user_id.required' => 'System Error',
            'body.required' => '本文が入力されていません。',
            'body.max:144' => '本文は144文字以下です。',
            'image.image' => '画像のファイル形式を確認してください。'
        ];
*/
        if ($request['image']) {
            $filename = $request->file('image')->getClientOriginalName();
            $params['image'] = $request['image']->storeAs('public/images', $filename);
        }
        Tweet::create($params);
        return redirect()->route('top');
/*
        $validator = Validator::make($form, $rules, $message);

        if($validator->fails()){
            return redirect('/post')
                ->withErrors($validator)
                ->withInput();
        }else{
            unset($form['_token']);
            $post->user_id = $request->user_id;
            $post->title = $request->title;
            $post->message = $request->message;
            $post->save();
            return redirect('/post');
        }
*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tweet_id)
    {
        $tweet = Tweet::findOrFail($tweet_id);
        return view('tweets.show', ['tweet' => $tweet]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tweet_id)
    {
        $tweet = Tweet::findOrFail($tweet_id);
        return view('tweets.edit', ['tweet' => $tweet]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tweet_id)
    {
        $params = $request->validate([
            'body' => 'required|max:144',
            'image' => 'image',
        ]);
        $params['user_id'] = Auth::id();
        $tweet = Tweet::findOrFail($tweet_id);
        $tweet->fill($params)->save();

        return redirect()->route('tweets.show', ['tweet' => $tweet]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $tweet = Tweet::findOrFail($tweet_id);
        \DB::transaction(function () use ($tweet) {
            $tweet->comments()->delete();
            $tweet->delete();
        });

        return redirect()->route('top');
    }
}
