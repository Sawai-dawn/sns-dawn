@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <div class='container'>
    <h1 class='page-header'></h1>
        <form action="/post/create" method="post">
        @csrf
      <div class="form-group">
      <img src="{{ asset('images/dawn.png') }}" alt="プロフィール画像" class="rounded-circle" style="height: 60px;">
      <input type="text" name="newPost" class="form-control" placeholder="何をつぶやこうか…？">
      </div>
      <div class="pull-right submit-btn">
        <button type="submit" class="btn btn-success"></button>
      </div>
    </form>

    <!--投稿ページへの遷移(この画面で投稿するため不要に)
    <p class="pull-right">
      <a class="btn btn-success" href="post/create-form">投稿する</a>
    </p>
    -->

    <h2 class='page-header'></h2>
    <table class='table table-hover'>
      <tr>
        <th>投稿No</th>
        <th>投稿者</th>
        <th>投稿内容</th>
        <th>投稿日時</th>
    <!-- ↓　ここを追加してください -->
    <th></th>
  </tr>
  @foreach ($posts as $post)
  <tr>
    <td>{{ $post->id }}</td>
    <td>{{ $post->user_id }}</td>
    <td>{{ $post->post }}</td>
    <td>{{ $post->created_at }}</td>
    <!-- ↓　ここから追加してください -->
    <td>
      <a class="btn btn-primary" href="/post/{{ $post->id }}/update-form"></a>
    </td>
    <!-- ↑　ここまで追加してください -->
         <!-- ↓　ここから下を追加してください -->
    <td>
    <form action="/post/delete" method="post" onclick="return confirm('この呟きを削除します。よろしいでしょうか？')">
        @method('DELETE')
        @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <button type="submit" class="btn btn-danger">削除</button>
      </form>
    </td>
    <!-- ↑　ここまでを追加してください -->
  </tr>
  @endforeach
</table>
  </div>

  @endsection
