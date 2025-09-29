<?php

use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\SupplementalController as APISupplementalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PR\PurchaseRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RFQController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Supplemental\SupplementalController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Models\Division;
use Illuminate\Http\Request;
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

// Authentications
Route::prefix('login')->group(function() {
    Route::get('/', [AuthController::class, 'loginView'])->name('login');
    Route::post('auth', [AuthController::class, 'authenticate']);
    Route::get('forgot_password', [AuthController::class, 'forgotPasswordView']);
});
Route::get('reset_password/{selector}/{token}', [AuthController::class, 'changePasswordView']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [ProfileController::class, 'homeView'])->name('home');
    // Route::get('logout', [AuthController::class, 'logout']);
    Route::get('dashboard', [ProfileController::class, 'homeView']);

    //Users Management Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserProfileController::class, 'userView'])->name("Users");
        Route::get('{id}/edit', [UserProfileController::class, 'userUpdateView'])->name("user.update");
        Route::get('list', [ProfileController::class, 'fetchUsers']);
    });
    
    // Purchase Request Routes
    Route::prefix('pr')->group(function() {
        Route::get('/', [PurchaseRequestController::class, 'prView'])->name('purchase request');
        Route::get('create', [PurchaseRequestController::class, 'createView'])->name('create.purchase.request');
        Route::get('{id}/edit', [PurchaseRequestController::class, 'updateView'])->name('edit.purchase.request');
        Route::get('{id}/track', [PurchaseRequestController::class, 'trackView'])->name('transaction.history');
        Route::get('view/{id}', [PurchaseRequestController::class, 'viewPR'])->name('view.purchase request');
        Route::get('process/{id}', [PurchaseRequestController::class, 'processView'])->name('process.purchase request');
    });
    
    Route::prefix('supplemental')->group(function() {
        Route::get('/', [SupplementalController::class, 'supplementalView'])->name('supplemental');
        Route::get('download/{splid}', [FileController::class, 'supplemental'])->name('supplemental.download');
        Route::get('view/{splid}', [FileController::class, 'viewSupplemental'])->name('supplemental.view');
    });

    Route::prefix('rfq')->group(function() {
        Route::get('/', [RFQController::class, 'rfqView'])->name('Request for Quotation');
    });

    Route::get('attachment/{id}', [FileController::class, 'attachment'])->name('attachment.download');
    
    // Authentication Routes
    Route::prefix('login')->group(function() {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('system')->group(function () {
    Route::post('sections', [SystemController::class, 'getSections']);
});

Route::get('/token', function () {
    return csrf_token();
});

Route::get('testing', [APISupplementalController::class, 'show']);

Route::get('upload/temporary', function(Request $request) {
    return decryptUrlSafe("ZXlKcGRpSTZJa3g2TlhwNVdsWldZV0V4VTB0NmFVaG5ORXAzUm1jOVBTSXNJblpoYkhWbElqb2lLMU52VFVzd01XWm9SaXRTWTI1SVkwcFVOVkkzUVQwOUlpd2liV0ZqSWpvaVlUQXdNRFZoTldSa05URXpPV0V5WVRZeU56aGlZek5oWldFd05tVTVOR0kyTTJFeU1EUXlPR0U1TURZd016VXdNVEU1TVRVellXRTJZVEprTm1JNFpTSXNJblJoWnlJNklpSjk");
});