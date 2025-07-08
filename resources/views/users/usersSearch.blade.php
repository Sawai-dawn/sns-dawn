@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <div class='container'>
    <form method="GET" action="{{ route('usersSearch') }}" class="search">
      <input type="text" name="keyword" value="{{ request('keyword') }}" class="value form-control" placeholder="ユーザー名">
      <button type="submit" class="btn btn-search"></button>
    </form>

    <div class="div-line"></div>


    <div class="all-users">
      @foreach ($users as $user)
        <div class="user-row">
          <a href="{{ route('users.profile', ['id' => $user->id]) }}">
            <img src="{{ $user->icon_image ? asset('storage/' . $user->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="user-icon">
          </a>
          <span class="value username">{{ $user->name }}</span>

        @if (Auth::user()->followings->contains($user->id))
        <!-- ログインユーザーがこのユーザーをフォロー済みなら -->

          <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-unfollow">フォローをはずす</button>
          </form>

        @else
        <!-- フォローしていない場合 -->

          <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-follow">フォローする</button>
          </form>

        @endif
        </div>
      @endforeach
    </div>

  </div>

@endsection
