<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');


Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:2,1');

    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('throttle:2,1');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('history', [HistoryController::class, 'index'])->name('history');
    Route::get('/fetch-user-activity-data', 'HistoryController@fetchUserActivityData')->name('fetch-user-activity-data');
    Route::get('audit-trail', [AuditTrailController::class, 'index'])->name('audit-trail');
});
