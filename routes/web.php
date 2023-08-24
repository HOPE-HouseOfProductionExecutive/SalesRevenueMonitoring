<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::group(['middleware'=>['auth']], function() {
    Route::get('/', function () {
        return view('layout.master');
    });
    Route::get('/revenue', [DataController::class, 'getData']);

    Route::get('/get/v1/data/revenue', [DataController::class, 'getDataJson'])->name('getDatas');




    Route::get('/user/management', [UserController::class, 'getUser']);

    Route::get('/logout', function () {
        Session::flush();
        Session::forget('user');
        Auth::logout();
        return redirect('/login');
    });
});

Route::fallback(function () {
    return view('page.login');
});

Route::get('/login', function () {
    return view('page.login');
})->name('login');

Route::post('/login/user', [AuthController::class, 'login']);

