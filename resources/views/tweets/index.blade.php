@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <a class="btn btn-primary" href="{{ route('tweets.create') }}">
                新規ツイート
            </a>
        </div>
        @foreach ($tweets as $tweet)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $tweet->user->name }}
                    <form
                        style="display: inline-block;"
                        method="POST"
                        action="{{ route('follows.store') }}"
                    >
                        @csrf
                        <input
                            name="followed_user_id"
                            type="hidden"
                            value="{{ $tweet->user->id }}"
                        >
                        <button type="submit" class="btn btn-primary">
                            フォロー
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {!! nl2br(e(Str::limit($tweet->body, 145))) !!}
                    </p>
                    @if ($tweet->image)
                        <img src="{{ Storage::url($tweet->image) }}" width="100px">
                        <br>
                    @endif
                    <form
                        style="display: inline-block;"
                        method="POST"
                        action="{{ route('tweetlikes.store') }}"
                    >
                        @csrf
                        <input
                            name="tweet_id"
                            type="hidden"
                            value="{{ $tweet->id }}"
                        >
                        <button type="submit" class="btn btn-primary">
                            いいね
                        </button>
                    </form>
                    <a class="card-link" href="{{ route('tweets.show', ['tweet' => $tweet]) }}">
                        詳細を見る
                    </a>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $tweet->created_at->format('Y.m.d') }}
                    </span>
                    @if ($tweet->tweetLikes->count())
                        <span class="badge badge-primary">
                            いいね {{ $tweet->tweetLikes->count() }}件
                        </span>
                    @endif
                    @if ($tweet->comments->count())
                        <span class="badge badge-primary">
                            コメント {{ $tweet->comments->count() }}件
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mb-5">
            {{ $tweets->links() }}
        </div>
    </div>
@endsection
