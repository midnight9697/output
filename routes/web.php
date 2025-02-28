<?php

use App\Http\Controllers\SettingController;
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
});

Route::get('divisions',[SettingController::class, 'divisionsView'])->name('manage.divisions');

Route::get('login', function() {
    return view('auth.login');
});
// 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