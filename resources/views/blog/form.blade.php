@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログ投稿フォーム</h2>
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" onSubmit="return checkSubmit()">
        @csrf
            <!--タイトルの入力フォーム-->
            <div class="form-group">
                <label for="title">
                    タイトル
                </label>
                <input
                    id="title"
                    name="title"
                    class="form-control"
                    value="{{ old('title') }}"
                    type="text"
                >
                <!--タイトルが入力されてない場合エラーメッセージ表示-->
                @if ($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <!--本文の入力フォーム-->
            <div class="form-group">
                <label for="content">
                    本文
                </label>
                <textarea
                    id="body"
                    name="body"
                    class="form-control"
                    rows="4"
                >{{ old('body') }}
                </textarea>
                <!--本文が入力されてない場合エラーメッセージ表示-->
                @if ($errors->has('body'))
                    <div class="text-danger">
                        {{ $errors->first('body') }}
                    </div>
                @endif                
            </div>
            <!--画像アップロードフォーム-->
            <div class="form-group">
            　<label for="image">
                    画像
            　</label>
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
    <script>
        function checkSubmit()
        {
        　if(window.confirm('送信してよろしいですか？'))
        　{
            return true;
        　} else 
        　　{
            return false;
        　　　}
         }
    </script>
@endsection