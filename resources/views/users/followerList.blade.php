@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <h2 style="color: #6c6c6c;">Follower list</h2>
  <div class='container'>


    <div class="user-icon-list">
      @forelse ($followings as $follower)
      <img src="{{ $follower->icon_image ? asset('storage/' . $follower->icon_image) : asset('images/dawn.png') }}" class="user-icon" alt="アイコン">

      @empty
        <p>フォローしているユーザーはいません。</p>

      @endforelse

    </div>

    <table class='table table-hover'>
      <tr>
        <th>投稿No</th>
        <th>投稿者画像</th>
        <th>投稿者</th>
        <th>投稿内容</th>
        <th>投稿日時</th>
    <!-- ↓　ここを追加してください -->
        <th></th>
      </tr>

      @foreach ($posts as $post)

      <tr>
        <td>{{ $post->id }}</td>
        <td>
          <img src="{{ $post->icon_image ? asset('storage/' . $post->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="rounded-circle" style="height: 40px;">
        </td>

        <td>{{ $post->user_name }}</td>
        <td>{!! nl2br(e($post->post)) !!}</td>
        <td>{{ $post->created_at }}</td>
    <!-- ↓　ここから追加してください -->
        <td>
          @if(auth()->id() === $post->user_id) <!-- ログインユーザーの投稿だけ表示 -->
            <a class="btn btn-primary" href="/post/{{ $post->id }}/update-form"></a>
          @endif
        </td>
    <!-- ↑　ここまで追加してください -->
    <!-- ↓　ここから下を追加してください -->
        <td>
          @if(auth()->id() === $post->user_id) <!-- ログインユーザーの投稿だけ削除ボタンを表示 -->
            <form action="/post/delete" method="post" onclick="return confirm('この呟きを削除します。よろしいでしょうか？')">
              @method('DELETE')
              @csrf
              <input type="hidden" name="id" value="{{ $post->id }}">
              <button type="submit" class="btn btn-danger"></button>
            </form>
          @endif
        </td>
    <!-- ↑　ここまでを追加してください -->
      </tr>

      @endforeach
    </table>
  </div>

@endsection
