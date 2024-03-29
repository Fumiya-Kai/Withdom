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
Route::group(['middleware' => 'auth'], function() {
    Route::get('/mypage', [App\Http\Controllers\User\UserController::class, 'mypage'])->name('mypage');

    Route::group(['middleware' => 'auth.team.session'], function() {
        Route::resource('team', App\Http\Controllers\User\TeamController::class)->except('show', 'create', 'store');
        Route::resource('article', App\Http\Controllers\User\ArticleController::class);
    });

    Route::resource('team', App\Http\Controllers\User\TeamController::class)->only('create', 'store');
    Route::get('/team/{teamId}', [App\Http\Controllers\User\TeamController::class, 'show'])->middleware('auth.team.route')->name('team.show');
    Route::get('/invite', [App\Http\Controllers\User\TeamController::class, 'showInviteForm'])->middleware('prevent.guest')->name('invite.form');
    Route::post('/invite', [App\Http\Controllers\User\TeamController::class, 'inviteToExistingTeam'])->middleware('prevent.guest')->name('invite.mail');
});

Route::post('article/{articleId}/comment', [App\Http\Controllers\User\Api\ArticleController::class, 'comment'])->name('comment');

Auth::routes(['register' => false]);
Route::get('/login_invited', [App\Http\Controllers\Auth\LoginController::class, 'showInvitedLogin'])->name('login.invited');
Route::get('/register_invited', [App\Http\Controllers\Auth\RegisterController::class, 'showInvitedRegister'])->name('register.invited');
Route::post('/register_invited', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::get('/login/guest', [App\Http\Controllers\Auth\LoginController::class, 'guestLogin'])->name('login.guest');

Route::get('/', function () {
    return redirect()->route('mypage');
});
