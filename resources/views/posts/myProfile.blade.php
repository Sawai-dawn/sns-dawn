@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <div class='container'>
    <h1 class='page-header'></h1>
    <div class="profile">
      <div class="profile-header">
      <img src="{{ asset('images/dawn.png') }}" alt="プロフィール画像" class="rounded-circle" style="height: 60px;">
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
          <button type="submit" class="btn btn-update">変更画面へ</button>
        </div>
      </div>
    </div>

    <div class="div-line"></div>

    <h2 class='page-header'></h2>
    <table class='table table-hover'>
      <tr>
        <th>投稿No</th>
        <th>投稿者</th>
        <th>投稿内容</th>
        <th>投稿日時</th>
        <th></th>
      </tr>

      @foreach ($posts as $post)

      <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->user_name }}</td>
        <td>{!! nl2br(e($post->post)) !!}</td>
        <td>{{ $post->created_at }}</td>
        <td>
          @if(auth()->id() === $post->user_id) <!-- ログインユーザーの投稿だけ表示 -->
          <a class="btn btn-primary" href="/post/{{ $post->id }}/update-form"></a>
          @endif
        </td>

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

      </tr>

      @endforeach

    </table>
  </div>

  @endsection
