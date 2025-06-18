<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // 追加
use App\Models\User;

class UsersController extends Controller
{
    public function updateProfile() //プロフィール編集画面
    {
        $user = Auth::user(); // ログインユーザーの情報を取得

        return view('users.updateProfile', compact('user')); // `users.updateProfile` ビューへ渡す
    }

    public function update(Request $request) //プロフィール更新機能
    {
        $user = Auth::user(); // ログインユーザーの情報を取得

        // バリデーション（データの安全性を確保）
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // 他のユーザーと重複しないように
            'password' => 'nullable|min:8|confirmed', // パスワード変更時のみ必須
            'bio' => 'nullable|string|max:500',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像ファイルのバリデーション
        ]);

        // 各項目を更新
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) { // パスワードが入力された場合のみ更新
            $user->password = bcrypt($request->password);
        }
        $user->bio = $request->bio;

        // 画像アップロード処理
        \Log::info('アップロードファイル:', [$request->file('icon_image')]);
        if ($request->hasFile('icon_image')) {
            \Log::info('ファイルはアップロードされています:', [$request->file('icon_image')]); // ファイル情報をログ出力

            $imagePath = $request->file('icon_image')->store('icons', 'public'); // ファイル保存
            \Log::info('保存されたパス:', [$imagePath]); // 保存後のパスをログ出力

            $user->icon_image = $imagePath; // ファイルパスをデータベースに保存
        }

        $user->save(); // データベースに保存

        return redirect()->route('updateProfile')->with('success', 'プロフィールが更新されました！');
    }

    public function usersSearch() //ユーザー検索画面
    {
        $users = User::where('id', '!=', Auth::id())->get(); // ログインユーザー以外の情報を取得
        $authUser = Auth::user(); // ログインユーザー情報

        return view('users.usersSearch', compact('users')); // `users.usersSearch` ビューへ渡す
    }
}
