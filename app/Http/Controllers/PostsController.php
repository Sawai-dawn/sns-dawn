<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // 追加


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
            $posts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id') // usersテーブルと結合
                ->select('posts.*', 'users.name as user_name') // ユーザー名を取得
                ->get();
            return view('posts.index', ['posts' => $posts]);
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

        public function updateForm($id){ //更新ページ
            $post = DB::table('posts')
                ->where('id', $id)
                ->first();
            return view('posts.updateForm', ['post' => $post]);
        }

        public function update(Request $request){ //更新機能
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
            $posts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id') // usersテーブルと結合
                ->select('posts.*', 'users.name as user_name') // ユーザー名を取得
                ->get();
            return view('posts.myProfile', ['posts' => $posts]);
        }

}
