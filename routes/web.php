<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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


Route::get('login', function () {
    return view('login');
})->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('article/{slug}', [SiteController::class, 'article'])->name('article');

Route::get('diaries', [SiteController::class, 'diary'])->name('diaries');

Route::post('diary', [SiteController::class, 'diaryPost'])->name('diary.post');

Route::get('diary/{id}', [SiteController::class, 'diaryUser'])->name('diary');

Route::get('chat', [ChatController::class, 'index'])->name('chat');
Route::post('findChat', [ChatController::class, 'search'])->name('chat.search');
Route::post('showChat', [ChatController::class, 'show'])->name('show.chat');
Route::post('listenChat', [ChatController::class, 'listen'])->name('listen.chat');
Route::post('postChat', [ChatController::class, 'post'])->name('post.chat');

Route::get('dev', [ChatController::class, 'dev']);

//admin
Route::get('admin/login', function () {
    return view('admin.login');
})->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login']);
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin/')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');
            Route::resource('article', ArticleController::class);
        });
    });
});
