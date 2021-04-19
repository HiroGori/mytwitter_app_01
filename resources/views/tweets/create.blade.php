@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                新規ツイート
            </h1>
            <form method="POST" action="{{ route('tweets.store') }}", enctype="multipart/form-data">
                @csrf
                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="body">
                            ツイート内容
                        </label>
                        <textarea
                            id="body"
                            name="body"
                            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image">
                            画像
                        </label>
                        <br>
                        <input id="image" type="file" name="image">
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>
                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('top') }}">
                            キャンセル
                        </a>
                        <button type="submit" class="btn btn-primary">
                            ツイートする
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
