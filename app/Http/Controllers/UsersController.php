<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // 追加

class UsersController extends Controller
{
    public function updateProfile() //プロフィール編集画面
    {
        $user = Auth::user(); // ログインユーザーの情報を取得

        return view('users.updateProfile', compact('user')); // `users.updateProfile` ビューへ渡す
    }
}
