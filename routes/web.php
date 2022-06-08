<?php

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

Route::get('/', [App\Http\Controllers\User\UserController::class, 'mypage'])->name('mypage');

Route::get('/teams/{teamId}', [App\Http\Controllers\User\TeamController::class, 'show'])->name('team.show');

Route::get('/team/create', function () {
    return view('team_create');
});

Route::get('/article/create', function () {
    return view('article_create');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
