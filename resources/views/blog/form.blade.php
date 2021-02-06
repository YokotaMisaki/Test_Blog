@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
<div class="row">
<script src="{{ asset('/js/check.js') }}"></script>
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログ投稿フォーム</h2>
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" onSubmit="return checkSubmit()">
        @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input id="title" name="title" class="form-control" value="{{ old('title') }}" type="text">
                @if ($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">本文</label>
                <textarea id="body" name="body" class="form-control" rows="4">
                {{ old('body') }}
                </textarea>
                @if ($errors->has('body'))
                    <div class="text-danger">
                        {{ $errors->first('body') }}
                    </div>
                @endif                
            </div>
            <div class="form-group">
            　<label for="image">画像</label>
            <br>
             <input type="file" name="image" accept="image/png, image/jpeg">
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('blogs') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    投稿する
                </button>
            </div>
        </form>
    </div>
</div>
@endsection