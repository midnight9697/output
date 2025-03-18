<?php

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

Route::get('/', function () {
    return view('admin.home');
})->name('Dashboard');

Route::get('divisions',[SettingController::class, 'divisionsView'])->name('manage.divisions');

Route::get('login', function() {
    return view('auth.login');
});

Route::prefix('users')->group(function () {
    Route::get('list', [ProfileController::class, 'fetchUsers']);
    Route::post('insert', [ProfileController::class, 'insertUser']);
    Route::post('update', [ProfileController::class, 'updateUser']);

    Route::get('/', [UserProfileController::class, 'userView'])->name("Users");
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