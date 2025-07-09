@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <div class='container'>
    <h1 class='page-header'></h1>
    <div class="profile">
      <div class="profile-header">
      <img src="{{ $user->icon_image ? asset('storage/' . $user->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="rounded-circle" style="height: 60px;">
      </div>

      <div class="profile-info">
        <div class="profile-item">
          <span class="label">UserName</span>
          <span class="value">{{ Auth::user()->name }}</span>
        </div>
        <div class="profile-item">
          <span class="label">MailAddress</span>
          <span class="value">{{ Auth::user()->email }}</span>
        </div>
        <div class="profile-item">
          <span class="label">BIO</span>
          <span class="value">{{ Auth::user()->bio }}</span>
        </div>
        <div class="profile-item">
          <a type="submit" class="btn btn-update" href="{{ route('updateProfile') }}">変更画面へ</a>
        </div>
      </div>
    </div>

    <div class="div-line"></div>

    <h2 class='page-header'></h2>
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

          <!-- ↑　ここまで追加してください -->
          <!-- ↓　ここから下を追加してください -->
          @if(auth()->id() === $post->user_id) <!-- ログインユーザーの投稿だけ削除ボタンを表示 -->
            <form action="/post/delete" method="post" onclick="return confirm('この呟きを削除します。よろしいでしょうか？')">
              @method('DELETE')
              @csrf
              <input type="hidden" name="id" value="{{ $post->id }}">
              <button type="submit" class="btn btn-danger"></button>
            </form>
          @endif
          <!-- ↑　ここまでを追加してください -->
        </div>

        <div class="div-line2"></div>

      </div>

      @endforeach
  </div>

  @endsection
