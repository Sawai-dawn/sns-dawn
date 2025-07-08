<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController; //追記
use App\Http\Controllers\UsersController; //追記

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(PostsController::class)->group(function() {
    Route::get('/hello', 'hello');
    Route::get('/index', 'index');
    Route::get('/post/create-form', 'createForm');
    Route::post('/post/create', 'create');
    Route::get('post/{id}/update-form', 'updateForm');
    Route::put('/post/update', 'update');
    Route::delete('/post/delete', 'delete');
    Route::get('/my-profile', 'myProfile')->name('myProfile');
});

Route::controller(UsersController::class)->group(function() {
    Route::get('/update-profile', 'updateProfile')->name('updateProfile');
    Route::post('/user/update', 'update')->name('user.update');
    Route::get('/users-search', 'usersSearch')->name('usersSearch');
    Route::post('/follow/{id}', 'follow')->name('follow');
    Route::post('/unfollow/{id}', 'unfollow')->name('unfollow');
    Route::get('/follow-list', 'followList')->name('followList');
    Route::get('/follower-list', 'followerList')->name('followerList');
    Route::get('/users/{id}', 'showProfile')->name('users.profile');
});
