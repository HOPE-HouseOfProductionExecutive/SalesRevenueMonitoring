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
    Route::get('/', [DataController::class, 'goToDashboard']);
    Route::get('/get/v1/data/revenue/total/spv', [DataController::class, 'getTotalSPV']);


    // Revenue
    Route::get('/revenue', [DataController::class, 'getData']);
    Route::get('/get/v1/data/revenue', [DataController::class, 'getDataJson'])->name('getDatas');
    Route::post('/add/v1/data/revenue', [DataController::class, 'addDataRevenue'])->name('addData');
    Route::put('/update/v1/data/revenue', [DataController::class, 'updateDataRevenue']);
    Route::delete('/delete/v1/data/revenue', [DataController::class, 'removeDataRevenue']);
    // ----------


    Route::get('/data/analytics', function () {
        return view('page.analytics');
        // Bus
    });



    Route::get('/user/management', [UserController::class, 'getUser']);
    Route::post('/user/management/add/user', [DataController::class, 'addUserData'])->name('addDataUser');




    Route::get('/user/profile', function () {
        return view('page.profile');
    });

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

