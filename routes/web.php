<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;

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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('arsip', ArsipController::class, ['except' => [
        'destroy'
    ]]);
    Route::post('/arsip/delete/{id}', [ArsipController::class, 'destroy'])->name('arsip.destroy');

    Route::resource('about', AboutController::class);

    Route::get('/logout', [LoginController::class, 'logout']);
});
