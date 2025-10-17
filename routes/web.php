<?php

use App\Http\Controllers\AbstractController;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\SupplementalController as APISupplementalController;
use App\Http\Controllers\APPController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BACController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\PPMPController;
use App\Http\Controllers\PR\PurchaseRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RFQController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Supplemental\SupplementalController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Models\Division;
use App\Models\Supplementary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use mikehaertl\pdftk\Pdf;
use setasign\Fpdi\Fpdi;

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
        Route::post('decrypt_action', [PurchaseRequestController::class, 'decrypt_action'])->name('process.decrypt_action');
    });

    Route::prefix('ppmp')->group(function() {
        Route::get('/', [PPMPController::class, 'index'])->name('ppmp request');
    });

    Route::prefix('app')->group(function() {
        Route::get('/', [APPController::class, 'index'])->name('app request');
    });

    Route::prefix('purchase_order')->group(function() {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchase order request');
    });

    Route::prefix('abstract')->group(function() {
        Route::get('/', [AbstractController::class, 'index'])->name('abstract request');
    });

    Route::prefix('division')->group(function() {
        Route::get('/', [DivisionController::class, 'index'])->name('division request');
    });

    Route::prefix('bac')->group(function() {
        Route::get('/', [BACController::class, 'index'])->name('bac request');
    });

    Route::prefix('inspector')->group(function() {
        Route::get('/', [InspectorController::class, 'index'])->name('inspector request');
    });

    Route::prefix('supplemental')->group(function() {
        Route::get('/', [SupplementalController::class, 'supplementalView'])->name('supplemental');
        Route::get('download/{splid}', [FileController::class, 'supplemental'])->name('supplemental.download');
        Route::get('update/{splid}', [SupplementalController::class, 'updateView'])->name('supplemental.update');
        Route::get('view/{splid}', [FileController::class, 'viewSupplemental'])->name('supplemental.view');
        Route::get('create', [SupplementalController::class, 'createView'])->name('supplemental.create');
    });

    Route::prefix('rfq')->group(function() {
        Route::get('/', [RFQController::class, 'rfqView'])->name('Request for Quotation');
        Route::get('form-create', [RFQController::class, 'rfqFormCreate'])->name('RFQ FORM CREATE');
        Route::get('form-update/{id}', [RFQController::class, 'rfqFormUpdateView'])->name('RFQ FORM UPDATE');
    });

    Route::prefix('supplier')->group(function() {
        Route::get('/', [SupplierController::class, 'index'])->name('supplier');
        Route::get('form-create', [SupplierController::class, 'create'])->name('create supplier');
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


Route::get('pdf-view', function() {

// Load existing PDF
    $pdf = new Fpdi();

    // Add a page from existing PDF
    $pdf->AddPage();
    $pdf->setSourceFile('files/testing.pdf');
    $templateId = $pdf->importPage(1);
    $pdf->useTemplate($templateId);
    $width_mm = pdfjsToMm(187.36199999999982); // width of the text
    $font_size = pdfjsToMm(9); // approx font size
    $height_mm = pdfjsToMm(9); // if available

    [$x, $y] = pdfjsToFpdiCoords(215.81, 696.82, 830);
    // Set font and position
    $pdf->SetFont('Helvetica', '', $font_size);
    // $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY($x, $y);
    $pdf->Cell($width_mm, $height_mm, "Sample Text"); // draw border

    // Insert new text
    // $pdf->Write(5, 'This is inserted text.');

    // Output the modified PDF
    $pdf->Output('I', 'modified.pdf');

});


