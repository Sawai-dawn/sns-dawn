@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <div class='container'>
    <div class="search">
      <input type="text" name="search" class="value form-control" placeholder="ユーザー名">
      <a class="btn btn-search" ></a>
    </div>

    <div class="div-line"></div>

    <div class="all-users">
      @foreach ($users as $user)
      <div class="user-row">
      <img src="{{ $user->icon_image ? asset('storage/' . $user->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="user-icon">
      <span class="value username">{{ $user->name }}</span>
      <button type="submit" class="btn btn-follow">フォローする</button>
    </div>
      @endforeach
    </div>

  </div>

@endsection
