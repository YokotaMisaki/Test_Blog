@extends('layout')
@section('title','ブログ詳細')
@section('content')
<!--画像がない場合本文の表示-->
@empty($blog->image)
<div class="row">
   <div class="col-md-8 col-md-offset-2 bg-secondary text-light">
    <h1>{{ $blog->title }}</h1>
      <div class="border-bottom" style="padding:10px;">
      　<span>作成日：{{ $blog->created_at }}</span>
  　　　<span>更新日：{{ $blog->updated_at }}</span>
      </div>
    <br>
      <div class="contener">
      {{ $blog->body }}
      </div>
</div>
      
<!--画像がある場合本文と画像表示-->
@else
<div class="row">
   <div class="col-md-8 col-md-offset-2 bg-secondary text-light">
      <h1>{{ $blog->title }}</h1>
      　<div class="border-bottom" style="padding:10px;">
      　　<span>作成日：{{ $blog->created_at }}</span>
  　　　　　<span>更新日：{{ $blog->updated_at }}</span>
      　 </div>
      <br>
      <div class="contener">
     　　 {{ $blog->body }}
      <div style="width: 18rem; float:left; margin: 16px;">
	<img src="../../uploads/{{ $blog->image }}"width="100px">
　　　 </div>
     </div>
  </div>
</div>
@endif

<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('blogs') }}">
    {{ __('戻る') }} </a>

@endsection
