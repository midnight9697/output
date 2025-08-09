<?php

use App\Http\Controllers\API\PurchaseRequestController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth', [UserController::class, 'authenticate']);
Route::prefix('login')->group(function() {
    Route::post('forgot_password', [UserController::class, 'send_forgot_password_link']);
    Route::post('reset_password', [UserController::class, 'reset_password']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function() {
        Route::get('getpage', [UserController::class, 'fetchByPage']);
        Route::get('all', [UserController::class, 'fetchAll']);
        Route::post('search', [UserController::class, 'search_user']);
        Route::post('insert', [UserController::class, 'insertUser']);
        Route::post('{id}/edit', [UserController::class, 'updateUser']);
    });

    Route::prefix('pr')->group(function() {
        Route::get('list', [PurchaseRequestController::class, 'fetch_all'])->name('list.pr');// get all PR
        Route::get('page', [PurchaseRequestController::class, 'fetch_by_page'])->name('page.pr'); //get PR by Page
        Route::post('create', [PurchaseRequestController::class, 'create_pr'])->name('create.pr'); //Create Or Update Uri
        Route::post('delete/{id}', [PurchaseRequest::class, 'delete_pr'])->name('delete.pr');    //Delete PR
        Route::post('search', [PurchaseRequestController::class, 'search_pr'])->name('search.pr');  //search for PR
    });
});

