<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\AssetController;
use App\Http\Controllers\Master\SupplierController;

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

Route::resource('categories', CategoryController::class);
Route::get('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');

Route::resource('suppliers', SupplierController::class);

Route::resource('assets', AssetController::class);
