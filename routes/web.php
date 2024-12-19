<?php

use Illuminate\Support\Facades\Route;

use App\Models\Transaction\AssetTransfer;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\AssetController;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\Master\AssetLocationController;
use App\Http\Controllers\Transaction\AssetPurchaseController;
use App\Http\Controllers\Transaction\AssetTransferController;
use App\Http\Controllers\Transaction\AssetMaintenanceController;
use App\Http\Controllers\Transaction\AssetRepairController;

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

Route::get('/get-asset-location/{assetId}', [AssetTransferController::class, 'getAssetLocation']);
