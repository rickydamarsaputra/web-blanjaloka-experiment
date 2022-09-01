<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return redirect()->route('auth.login.view');
});

Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', 'loginView')->name('login.view');
    Route::get('/google/redirect', 'oauthGoogleRedirect')->name('google.redirect');
    Route::get('/google/callback', 'oauthGoogleCallback')->name('google.callback');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::view('/', 'pages.dashboard.index')->name('index');
});
