<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PR\PurchaseRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Models\Division;
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



Route::get('divisions',[SettingController::class, 'divisionsView'])->name('manage.divisions');



Route::prefix('login')->group(function() {
    Route::get('/', [AuthController::class, 'loginView'])->name('login');
    Route::post('auth', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [ProfileController::class, 'homeView'])->name('main');
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('dashboard', [ProfileController::class, 'homeView']);
    //Users View
    Route::prefix('users')->group(function () {
        Route::get('list', [ProfileController::class, 'fetchUsers']);
        Route::get('/', [UserProfileController::class, 'userView'])->name("Users");
    });

    Route::get('pr', [PurchaseRequestController::class, 'prView'])->name('purchase request');
});

Route::prefix('system')->group(function () {
    Route::post('sections', [SystemController::class, 'getSections']);
});

Route::get('/token', function () {
    return csrf_token();
});

Route::get('testing', function() {
    return view('admin.test');
});