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

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth'], function(){
    Route::resource('arsip', ArsipController::class, ['except' => [
        'destroy', 'arsip.update'
    ]]);
    Route::post('/arsip/update/{id}', [ArsipController::class, 'update'])->name('arsip.update');
    Route::post('/arsip/delete/{id}', [ArsipController::class, 'destroy'])->name('arsip.destroy');
    Route::get('/arsip/cari/{word}', [ArsipController::class, 'cari'])->name('arsip.cari');

    Route::resource('about', AboutController::class);

    Route::get('/logout', [LoginController::class, 'logout']);
});
