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
          <input type="text" name="upProfile" value="{{$user->name}}" class="value form-control" required>
        </div>
        <div class="profile-item">
          <span class="label">MailAddress</span>
          <input type="text" name="upProfile" value="{{$user->email}}" class="value form-control" required>
        </div>
        <div class="profile-item">
          <span class="label">Password</span>
          <input type="password" name="upProfile" class="value form-control" required>
        </div>
        <div class="profile-item">
          <span class="label">Password Confirm</span>
          <input type="password" name="upProfile" class="value form-control" required>
        </div>
        <div class="profile-item">
          <span class="label">BIO</span>
          <textarea name="upProfile" value="{{$user->bio}}" class="value form-control" required rows="4">{{ old('upProfile', $user->bio) }}</textarea>
        </div>
        <div class="profile-item">
          <span class="label">Icon Image</span>
          <span class="value form-control">
            <button type="submit" class="btn btn-upload">ファイルを選択</button>
          </span>
        </div>
        <div class="profile-item right">
          <button type="submit" class="btn btn-update">更　新</button>
        </div>
      </div>
    </div>

    <h2 class='page-header'></h2>

  </div>

  @endsection
