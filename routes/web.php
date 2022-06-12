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

Route::resource('team', App\Http\Controllers\User\TeamController::class)->except('show');
Route::get('/team/{teamId}', [App\Http\Controllers\User\TeamController::class, 'show'])->middleware('auth.team')->name('team.show');

Route::resource('article', App\Http\Controllers\User\ArticleController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
