@extends('layout')
@section('title','ブログ一覧')
@section('content')
  <div class="row">
   <div class="col-md-8 col-md-offset-2">
      <h2>ブログ記事一覧</h2>
       <!--検索フォーム-->
        <form class="form-inline" action="{{url('/search')}}" method="GET">
            <div class="form-group">
             <input type="text" name="keyword" value="@if (isset( $keyword )) @endif"
              class="form-control" placeholder="キーワード入力">
             <input type="submit" value="検索" >
             </div>
        </form>
     <!--ブログ登録・削除成功時メッセージ表示-->
      @if (session('err_msg'))
          <p class="text-danger">{{ session('err_msg') }}
          </p>
      @endif
      <table class="table table-striped">
          <tr>
        　  <th>記事番号</th>
        　  <th>タイトル</th>
        　  <th>日付</th> 
            <!--ログイン時のみ削除ボタンを表示する-->
        　 @auth<th></th>@endauth
         </tr>
         <tr>
          <!--データベースからそれぞれのデータ取得-->
          @foreach($blogs as $blog)
              <td>{{ $blog->id }}</td>
              <td><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></td>
              <td>{{ $blog->updated_at }}</td>
              <!--ログイン時のみ削除ボタンを表示する-->
              @auth
              <form method="POST" action="{{ route('delete',$blog->id) }}" onSubmit="return checkDelete()">
              @csrf
              <td><button type="submit" class='btn btn-primary' onclick=>削除</button></td>
              @endauth
         </tr>
           @endforeach
     </table>
     <!--ページネーションを反映-->
      {{ $blogs->links() }}
      <br>
  </div>
</div>
    <script>
        function checkDelete()
        {
            if(window.confirm('削除してよろしいですか？'))
            {
                return true;
            } else 
            {
                return false;
            }
        }
    </script>
@endsection
