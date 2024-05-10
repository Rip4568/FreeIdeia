<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas web para seu aplicativo. Essas
| rotas são carregadas pelo RouteServiceProvider e todas elas serão
| atribuídas ao grupo de middleware "web". Faça algo incrível!
|
*/

Route::get('/', function () {
    $data = [
        "posts" => Post::orderBy('created_at', 'desc')->take(6)->get(),
        "posts_quantity" => Post::all()->count(),
        "users_quantity" => User::all()->count(),
        "posts_clicked_quantity" => Post::sum('clicked'),
    ];
    return view('welcome', $data);
})->name('welcome');

Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');
Route::post('/login', [UserController::class, 'login'])
    ->name('users.login');
Route::get('/login', [UserController::class, 'showLogin'])
    ->name('users.showLogin');

Route::resource('posts', PostController::class)
    ->middleware(['auth', 'add.user.id']);

Route::resource('users', UserController::class)
    ->except(['showLogin', 'store'])
    ->middleware(['auth', 'add.user.id']);

Route::resource('posts.comments', CommentController::class)
    ->only(['store', 'destroy', 'update'])
    ->middleware(['auth', 'add.user.id']);


Route::match((['get', 'post']), '/follow/{user}', [FollowController::class, 'follow'])
    ->name('follow');
Route::match((['get', 'post']), '/unfollow/{user}', [FollowController::class, 'unfollow'])
    ->name('unfollow');