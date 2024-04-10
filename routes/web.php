<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $data = [
        "posts" => Post::orderBy('created_at', 'desc')->take(6)->get(),
        "posts_quantity" => Post::all()->count(),
        "users_quantity" => User::all()->count()
    ];
    return view('welcome', $data);
});
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'login'])->name('users.login');
Route::get('/login', [UserController::class, 'showLogin'])->name('users.showLogin');

Route::resource('posts', PostController::class)->middleware(['auth', 'add.user.id']);//['store', 'destroy', 'edit', 'update', 'edit', 'show']

Route::resource('users', UserController::class);