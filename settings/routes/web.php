<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\UsersController;


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

// Route::get('/', [AuthController::class, 'index'])->name('login');

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:2,1');

    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('throttle:2,1');
});



Route::group(['middleware' => 'auth'], function () {
    //Route::get('home',[AuthController::class,'home'])->name('home');
    Route::get('home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('permission', [PermissionController::class, 'index'])->name('permission');
    Route::get('audit-trail', [AuditTrailController::class, 'index'])->name('audit-trail');
    Route::get('/fetch-user-audit-data', 'AuditTrailController@fetchUserAuditData')->name('fetch-user-audit-data');
    Route::get('/fetch-access-config-audit-data', [AuditTrailController::class, 'fetchAccessConfigAuditData'])
    ->name('fetch-access-config-audit-data');

    // get userslist for the modal
    Route::get('/get-users-list', 'UsersController@getUsersList');

    Route::get('/fetch-user-audit-data', 'UsersController@fetchUserAuditData')->name('fetch-user-audit-data');
    Route::resource('roles', 'RoleController');
    
    // Create a new role (GET request)
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');

    // Store a new role (POST request)
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');

    // Store a new toggle state (POST request)
    Route::post('roles/save', [RoleController::class, 'store'])->name('roles.save');

    // Store a new toggle state (POST request)
    Route::post('/roles/saved', [RoleController::class, 'saveSettings'])->name('roles.saved');

    // Show existing roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    // Check if there are users with the selected role
    Route::get('roles/checkUsers/{roleId}', [RoleController::class, 'checkUsers'])->name('roles.checkUsers');

    Route::get('roles/{id}', [RoleController::class, 'test']);

    // Add the new route for Operation Management
    Route::get('operation-management', [OperationController::class, 'showOperationManagementPage'])->name('operation-management');
    
    // Add the new route for Users
    Route::get('users', [UsersController::class, 'showUsersPage'])->name('users');
});

//to create activities and storing it in the database.
Route::group(['middleware' => ['auth', 'log.activity']], function () {
    Route::resource('roles', 'RoleController');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
});