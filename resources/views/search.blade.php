@extends('layout')
@section('title','ブログ一覧')
@section('content')
  <div class="row">
  <script src="{{ asset('/js/search.js') }}"></script>
  <script src="{{ asset('/js/delete.js') }}"></script>
   <div class="col-md-8 col-md-offset-2">
      <h2>ブログ記事一覧</h2>
          <div class="form-group">
            <form class="form-inline" action="{{url('/search')}}" method="GET">
             <input type="text" name="keyword" value="@if (isset( $keyword )) @endif" placeholder="キーワード入力" >
             <input type="button" id="search-icon" value="検索" onclick="buttonClick()">
             </form>
          </div>  
      @if (session('err_msg'))
          <p class="text-danger">{{ session('err_msg') }}
          </p>
      @endif
      <table class="table table-striped" id="table">
          <tr>
        　  <th>記事番号</th>
        　  <th>タイトル</th>
        　  <th>日付</th> 
        　 @auth<th></th>@endauth
         </tr>
         <tr>
          @foreach($blogs as $blog)
              <td>{{ $blog->id }}</td>
              <td><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></td>
              <td>{{ $blog->updated_at }}</td>
              @auth
              <form method="POST" action="{{ route('delete',$blog->id) }}" onSubmit="return checkDelete()">
              @csrf
              <td><button type="submit" class='btn btn-primary' onclick=>削除</button></td>
              @endauth
         </tr>
           @endforeach
     </table>
      {{ $blogs->links() }}
      <br>
  </div>
</div>
@endsection
