<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('blogs') }}">ブログ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
 　 @guest
  　　　<a class="nav-item nav-link navbar-light" href="/login">ログイン</a>
  　　　<a class="nav-item nav-link" href="/register">新規登録</a>
  　@endguest
      <a class="nav-item nav-link active" href="{{ route('blogs') }}">ブログ一覧<span class="sr-only"></span></a>
      @auth<a class="nav-item nav-link" href="{{ route('create') }}">ブログ投稿</a>@endauth
      @auth
      <form method="POST" action="{{ route('logout') }}">
      @csrf
        <x-jet-dropdown-link href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                    this.closest('form').submit();">
                  {{ __('ログアウト') }}
        </x-jet-dropdown-link>
      </form>
    　@endauth
  </div>
</nav>