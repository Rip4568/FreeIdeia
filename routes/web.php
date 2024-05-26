<?php

use App\Events\NotificationEvent;
use App\Events\WelcomeNotificationEvent;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
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
        "user" => Auth::user(),
        "posts" => Post::orderBy('created_at', 'desc')->take(6)->get(),
        "posts_quantity" => Post::all()->count(),
        "users_quantity" => User::all()->count(),
        "posts_clicked_quantity" => Post::sum('clicked'),
    ];
    return view('welcome', $data);
})->name('welcome');


Route::get('/notification-test', function () {
    $user = Auth::user();
    event(new NotificationEvent($user, 'Teste de notificação', 'Teste de notificação', 'primary'));
    return redirect()->route('welcome');
})
    ->name('notifications.test')
    ->middleware('auth');

Route::get('/welcome-test', function () {
    $user = Auth::user();
    event(new WelcomeNotificationEvent($user));
    return redirect()->route('welcome');
})
    ->name('notifications.welcome.test')
    ->middleware('auth');

Route::get('test-ajax', function () {
    return response()->json(['message' => 'Hello World!']);
})->name('test-ajax');

Route::get('/pulse', function () {
    return view('pulse::dashboard');
})->name('pulse')->middleware(['auth', 'can:admin']);

Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');

Route::post('/login', [UserController::class, 'login'])
    ->name('users.login');

Route::get('/login', [UserController::class, 'showLogin'])
    ->name('users.showLogin');

Route::resource('users', UserController::class);

Route::resource('posts', PostController::class)
    ->middleware(['auth', 'add.user.id', 'increment.post.clicked']);

Route::resource('posts.comments', CommentController::class)
    ->only(['store', 'destroy', 'update'])
    ->middleware(['auth', 'add.user.id']);

Route::match((['get', 'post']), '/follow/{user}', [FollowController::class, 'follow'])
    ->name('follow');

Route::match((['get', 'post']), '/unfollow/{user}', [FollowController::class, 'unfollow'])
    ->name('unfollow');


/* Noptications Roues */
Route::resource('notifications', NotificationController::class)
    ->only(['index', 'destroy'])
    ->middleware('auth');

Route::get('clear', [NotificationController::class, 'destroyAll'])
    ->name('notificaions.clear')
    ->middleware('auth');