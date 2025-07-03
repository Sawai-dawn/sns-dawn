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

    public function usersSearch(Request $request) // ユーザー検索画面
    {
        $keyword = $request->input('keyword'); // 入力された検索ワード
        $authUser = Auth::user();

        $users = User::where('id', '!=', $authUser->id) // ログインユーザー以外の情報を取得,キーワードがあればそれを含むやつ
                    ->when($keyword, function ($query, $keyword) {
                        return $query->where('name', 'like', "%{$keyword}%");
                    })
                    ->get();

        return view('users.usersSearch', compact('users', 'authUser', 'keyword')); // `users.usersSearch` ビューへ渡す
    }

    public function followings() //自分がフォローしてる一覧
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function followers() //自分をフォローしている一覧
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function follow($id) //フォロー機能
    {
        $user = Auth::user(); // ログインユーザー
        $target = User::findOrFail($id); // フォロー対象のユーザー

        // 重複チェック（すでにフォローしていなければ追加）
        if (!$user->followings()->where('followed_id', $target->id)->exists()) {
            $user->followings()->attach($target->id,['created_at' => now(), 'updated_at' => now()]);
        }

        return back(); // 元の画面に戻る
    }

    public function unfollow($id) //アンフォロー機能
    {
        $user = Auth::user(); // ログインユーザー
        $target = User::findOrFail($id); // フォロー解除対象のユーザー

        // フォロー関係があれば解除
        if ($user->followings()->where('followed_id', $target->id)->exists()) {
            $user->followings()->detach($target->id);
        }

        return back(); // 元の画面へ戻す
    }

    public function followList()
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        $followings = $user->followings; // フォローしてるユーザー一覧

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id') // usersテーブルと結合
            ->select('posts.*', 'users.name as user_name', 'users.icon_image') // ユーザー名とユーザー画像を取得
            ->get();

        return view('users.followList', compact('followings','posts')); // `$followings`と$posts をビューに渡す
    }

    public function followerList()
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        $followings = $user->followers; // フォローしてくれているユーザー一覧

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id') // usersテーブルと結合
            ->select('posts.*', 'users.name as user_name', 'users.icon_image') // ユーザー名とユーザー画像を取得
            ->get();

        return view('users.followerList', compact('followings','posts')); // `$followings`と$posts をビューに渡す
    }
}
