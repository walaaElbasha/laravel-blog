<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
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

Route::group(['middleware' => ['auth']],function(){

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');


});


Route::get('/auth/redirect/github', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->stateless()->user();
    $exists = User::where('email', '=', $user->email)->first();
    if ($exists) {
        Auth::login($exists, true);
        return redirect()->route('posts.index');
    } else {
        $user = User::create([
            'name'  => $user->nickname,
            'email' => $user->email,
            'password' => Hash::make('12345678')
        ]);
        Auth::login($user, true);
        return redirect()->route('posts.index');
    }
});

Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback/google', function () {
    $user = Socialite::driver('google')->stateless()->user();
    $exists = User::where('email', '=', $user->email)->first();
    if ($exists) {
        Auth::login($exists, true);
        return redirect()->route('posts.index');
    } else {
        $user = User::create([
            'name'  => $user->name,
            'email' => $user->email,
            'password' => Hash::make('12345678')
        ]);
        Auth::login($user, true);
        return redirect()->route('posts.index');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
