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
        <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
        @csrf
          <div class="profile-item">
            <span class="label">UserName</span>
            <input type="text" name="name" value="{{$user->name}}" class="value form-control" required>
          </div>
          <div class="profile-item">
            <span class="label">MailAddress</span>
            <input type="text" name="email" value="{{$user->email}}" class="value form-control" required>
          </div>
          <div class="profile-item">
            <span class="label">Password</span>
            <input type="password" name="password" class="value form-control" placeholder="新しいパスワードを入力（変更しない場合は空欄）">
          </div>
          <div class="profile-item">
            <span class="label">Password Confirm</span>
            <input type="password" name="password_confirmation" class="value form-control" placeholder="確認用パスワード">
          </div>
          <div class="profile-item">
            <span class="label">BIO</span>
            <textarea name="bio" class="value form-control" required rows="4">{{ old('bio', $user->bio) }}</textarea>
          </div>
          <div class="profile-item">
            <span class="label">Icon Image</span>
            <span class="value form-control">
              <input type="file" name="icon_image" class="btn btn-upload" accept="image/*">
            </span>
          </div>
          <div class="profile-item right">
            <button type="submit" class="btn btn-update">更　新</button>
          </div>
        </form>
      </div>
    </div>

    <h2 class='page-header'></h2>

  </div>

  @endsection
