<?php

use App\Http\Controllers\API\ABSTRACTController;
use App\Http\Controllers\API\APPController;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\PPMPController;
use App\Http\Controllers\API\PurchaseRequestController;
use App\Http\Controllers\API\RFQController;
use App\Http\Controllers\API\SupplementalController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Supplier;
use App\Http\Controllers\API\SupplierController;
use App\Models\Alternative;
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

Route::post('auth', [UserController::class, 'authenticate']);
Route::prefix('login')->group(function() {
    Route::post('forgot_password', [UserController::class, 'send_forgot_password_link']);
    Route::post('reset_password', [UserController::class, 'reset_password']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function() {
        Route::get('getpage', [UserController::class, 'fetchByPage']);
        Route::get('all', [UserController::class, 'fetchAll']);
        Route::get('search', [UserController::class, 'search_user']);
        Route::post('insert', [UserController::class, 'insertUser']);
        Route::post('{id}/edit', [UserController::class, 'updateUser']);
    });

    Route::prefix('pr')->group(function() {
        Route::get('list', [PurchaseRequestController::class, 'fetch_all'])->name('list.pr');// get all PR
        Route::get('page', [PurchaseRequestController::class, 'fetch_by_page'])->name('page.pr'); //get PR by Page
        Route::post('create', [PurchaseRequestController::class, 'create_pr'])->name('create.pr'); //Create Or Update Uri
        Route::post('delete/{id}', [PurchaseRequestController::class, 'delete_pr'])->name('delete.pr');    //Delete PR
        Route::post('{id}/edit', [PurchaseRequestController::class, 'edit_pr'])->name('edit.pr');    //Edit PR
        Route::post('search', [PurchaseRequestController::class, 'search_pr'])->name('search.pr');  //search for PR
        Route::get('{id}/items', [PurchaseRequestController::class, 'fetch_pr_items'])->name('pr.items');  //search for PR
        Route::post('comment', [PurchaseRequestController::class, 'make_transaction'])->name('pr.comment'); // submit comments and reviews
        Route::post('route', [PurchaseRequestController::class, 'route_pr'])->name('pr.route'); //  route to assigned personnel
        Route::post('{id}/receive', [PurchaseRequestController::class, 'receive_pr'])->name('pr.receive'); //  receive to assigned personnel
        Route::post('attachment/upload', [FileController::class, 'uploadAttachment'])->name('attachment.upload'); //  receive to assigned personnel
        Route::post('generate_pr_number', [PurchaseRequestController::class, 'generate_pr_number'])->name('pr.generate');
        Route::post('decrypt_action', [PurchaseRequestController::class, 'decrypt_action']);
        Route::get('closed_pr', [PurchaseRequestController::class, 'fetch_close_pr_by_page'])->name('fetch_close_pr_by_page');
        Route::get('outbox_pr', [PurchaseRequestController::class, 'fetch_outbox_pr_by_page'])->name('fetch_outbox_pr_by_page');
        Route::get('track_pr', [PurchaseRequestController::class, 'fetch_track_pr_by_page'])->name('fetch_track_pr_by_page');
        Route::get('inbox_pr', [PurchaseRequestController::class, 'fetch_inbox_pr_by_page'])->name('fetch_inbox_pr_by_page');


    });

    Route::prefix('rfq')->group(function() {
        Route::get('page', [RFQController:: class, 'fetch_by_page']);
        Route::post('one', [RFQController:: class, 'fetch_rfq']);
        Route::post('templates', [RFQController:: class, 'fetch_template']);
        Route::post('create_template', [RFQController:: class, 'create_rfq_template']);
        Route::post('create', [RFQController:: class, 'create_rfq']);
        Route::post('update', [RFQController:: class, 'update_rfq']);
        Route::get('counter', [RFQController:: class, 'countRFQ']);
    });

    Route::prefix('supplemental')->group(function() {
        Route::post('upload', [SupplementalController::class, 'upload_file']);
        Route::get('page', [SupplementalController::class, 'fetch_by_page']);
        Route::get('{id}', [SupplementalController::class, 'fetch_supplemental']);
        Route::post('create', [SupplementalController::class, 'create']);
        Route::post('update', [SupplementalController::class, 'update']);
        Route::post('remove', [SupplementalController::class, 'rmvFile'])->name('supplemental.remove');
    });

    Route::prefix('supplier')->group(function() {
        Route::get('/get_all_supplier', [SupplierController::class, 'get_all_supplier']);
        Route::post('/create', [SupplierController::class, 'create']);
        Route::post('/remove', [SupplierController::class, 'remove']);
        Route::post('/update', [SupplierController::class, 'update']);
    });

    Route::prefix('ppmp')->group(function() {
        Route::get('page',  [PPMPController::class, 'fetch_by_page']);
        Route::post('remove',  [PPMPController::class, 'remove']);
        Route::post('create', [PPMPController::class, 'uploadAttachment']);
    });

    Route::prefix('app')->group(function() {
        Route::get('page',  [APPController::class, 'fetch_by_page']);
        Route::post('remove',  [APPController::class, 'remove']);
        Route::post('create', [APPController::class, 'uploadAttachment']);
    });

    Route::prefix('abstract')->group(function() {
        Route::get('page', [ABSTRACTController::class, 'fetch_by_page']);
        Route::post('bidders', [ABSTRACTController::class, 'fetch_rfq_bidders']);
        Route::post('create', [ABSTRACTController::class, 'create']);
    });

    Route::post('alternative', function(Request $request) {
        return encryptUrlSafe($request->id);
    });
});