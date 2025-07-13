@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <h2 style="color: #6c6c6c;">Follower list</h2>
  <div class='container'>


  <div class="user-icon-list">
      @forelse ($followings as $follower)
        <a href="{{ route('users.profile', ['id' => $follower->id]) }}">
          <img src="{{ $follower->icon_image ? asset('storage/' . $follower->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="user-icon">
        </a>

      @empty
        <p>フォローしているユーザーはいません。</p>

      @endforelse
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
