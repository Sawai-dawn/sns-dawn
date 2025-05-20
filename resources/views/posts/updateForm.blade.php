@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <div class='container'>
    <form action="/post/update/" method="post">
      @method('PUT')
      @csrf
      <div class="form-group">
      <img src="{{ asset('images/dawn.png') }}" alt="プロフィール画像" class="rounded-circle" style="height: 60px;">
        <input type="hidden" name="id" value="{{$post->id}}">
        <input type="text" name="upPost" value="{{$post->post}}" class="form-control" required>
      </div>
      <div class="pull-right submit-btn">
        <button type="submit" class="btn btn-primary"></button>
      </div>
    </form>
  </div>

  @endsection
