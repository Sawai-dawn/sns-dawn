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

    @forelse ($posts as $post)
      <div class="post">
        <p>{{ $post->post }}</p>
        <small>{{ $post->created_at->format('Y/m/d H:i') }}</small>
      </div>
    @empty
      <p>投稿はまだありません。</p>
    @endforelse


  </div>

@endsection
