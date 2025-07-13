@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <div class='container'>

    <div class="profile">
      <div class="profile-header">
        <img src="{{ $user->icon_image ? asset('storage/' . $user->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="rounded-circle" style="height: 60px;">
      </div>

      <div class="profile-info">
        <div class="profile-item2">
          <span class="label">UserName</span>
          <span class="value">{{ $user->name }}</span>
        </div>

        @if ($user->bio)
        <div class="profile-item2">
          <span class="label">BIO</span>
          <span class="value bio">{{ $user->bio }}</span>
        </div>
        @endif
      </div>

        <div class="profile-item2">
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

    </div>

    <div class="div-line"></div>

    @foreach ($posts as $post)

    <div class="post-card">
      <div class="post-header">
      @if(auth()->id() === $post->user_id)
        <a href="{{ route('myProfile') }}">
          <img src="{{ $post->user->icon_image ? asset('storage/' . $post->user->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="user-icon">
        </a>

      @else
        <a href="{{ route('users.profile', ['id' => $post->user_id]) }}">
          <img src="{{ $post->user->icon_image ? asset('storage/' . $post->user->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="user-icon">
        </a>

      @endif

        <div class="post-meta">
          <span class="post-user">{{ $post->user->name }}</span>
          <span class="post-date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
        </div>
      </div>

      <div class="post-content">
        {!! nl2br(e($post->post)) !!}
      </div>

      <div class="post-actions">
        @if(auth()->id() === $post->user_id) <!-- ログインユーザーの投稿だけ表示 -->
          <a class="btn btn-primary" href="/post/{{ $post->id }}/update-form"></a>

        @endif

        @if(auth()->id() === $post->user_id) <!-- ログインユーザーの投稿だけ削除ボタンを表示 -->
          <form action="/post/delete" method="post" onclick="return confirm('この呟きを削除します。よろしいでしょうか？')">
            @method('DELETE')
            @csrf
            <input type="hidden" name="id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-danger"></button>
          </form>

        @endif

      </div>

      <div class="div-line2"></div>

    </div>

    @endforeach

  </div>

@endsection
