<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // 追加
use App\Models\Post;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //ここに以下を追記する。
    public function hello()
    {
        echo 'Hello World!!<br>';
        echo 'コントローラーから';
    }

    public function index() //投稿一覧
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        $followings = $user->followings; // フォローしてるユーザー一覧
        $userIds = $followings->pluck('id')->push($user->id); // ログインユーザーのIDとフォローしてるユーザーのIDをまとめる(pushで自身のIDも追加)

        $posts = Post::with('user')  // 投稿に紐づくユーザーを取得
                     ->whereIn('user_id', $userIds) // $userIdsにまとめたidの投稿を取得
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('posts.index', compact('user', 'posts'));
    }

    public function createForm() //投稿ページ
    {
        return view('posts.createForm');
    }

    public function create(Request $request) //投稿機能
    {
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'user_id' => auth()->id(), // 現在ログインしているユーザーのIDを取得,
            'post' => $post,
            'created_at' => now(),
        ]);
        return redirect('/index');
    }

    public function updateForm($id) //更新ページ
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', compact('user', 'post')); // `$user`と$post をビューに渡す
    }

    public function update(Request $request) //更新機能
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );
        return redirect('/index');
    }

    public function delete(Request $request) //削除機能
    {
        $id = $request->input('id');
        DB::table('posts')
        ->where('id', $id)
        ->delete();
        return redirect('/index');
    }

    public function myProfile() //プロフィール画面
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        $posts = Post::where('user_id', $user->id)  // ログインユーザーの投稿のみを取得
        ->orderBy('created_at', 'desc')
        ->get();
        return view('posts.myProfile', compact('user', 'posts')); // `$user`と$posts をビューに渡す
    }

}
