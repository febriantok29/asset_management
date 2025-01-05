<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\AssetController;
use App\Http\Controllers\Master\AssetLocationController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Transaction\AssetMaintenanceController;
use App\Http\Controllers\Transaction\AssetPurchaseController;
use App\Http\Controllers\Transaction\AssetRepairController;
use App\Http\Controllers\Transaction\AssetTransferController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('master')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('asset_locations', AssetLocationController::class);
    Route::resource('assets', AssetController::class);
});

Route::prefix('transaction')->group(function () {
    Route::resource('asset_purchases', AssetPurchaseController::class);
    Route::resource('asset_transfers', AssetTransferController::class);
    Route::resource('asset_maintenances', AssetMaintenanceController::class);
    Route::resource('asset_repairs', AssetRepairController::class);
});

Route::prefix('report')->group(function () {
    Route::get('assets-summary', [ReportController::class, 'assetsSummary'])->name('report.assets_summary');
    Route::get('assets-summary/pdf', [ReportController::class, 'assetsSummaryPdf'])->name('report.assets_summary.pdf');
    Route::get('assets-summary/excel', [ReportController::class, 'assetsSummaryExcel'])->name('report.assets_summary.excel');

    Route::get('vendor-purchases', [ReportController::class, 'vendorPurchases'])->name('report.vendor_purchases');
    Route::get('vendor-purchases/pdf', [ReportController::class, 'vendorPurchasesPdf'])->name('report.vendor_purchases.pdf');
    Route::get('vendor-purchases/excel', [ReportController::class, 'vendorPurchasesExcel'])->name('report.vendor_purchases.excel');

    Route::get('location-transfers', [ReportController::class, 'locationTransfers'])->name('report.location_transfers');
    Route::get('location-transfers/pdf', [ReportController::class, 'locationTransfersPdf'])->name('report.location_transfers.pdf');
    Route::get('location-transfers/excel', [ReportController::class, 'locationTransfersExcel'])->name('report.location_transfers.excel');

    Route::get('maintenance-repairs', [ReportController::class, 'maintenanceRepairs'])->name('report.maintenance_repairs');
    Route::get('maintenance-repairs/pdf', [ReportController::class, 'maintenanceRepairsPdf'])->name('report.maintenance_repairs.pdf');
    Route::get('maintenance-repairs/excel', [ReportController::class, 'maintenanceRepairsExcel'])->name('report.maintenance_repairs.excel');
});

Route::get('/get-asset-location/{assetId}', [AssetTransferController::class, 'getAssetLocation']);
