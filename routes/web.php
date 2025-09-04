<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminSparePartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form-service', [ServiceController::class, 'index'])->name('form-service');
Route::get('/api/serial-numbers', [ServiceController::class, 'getSerialNumbers'])->name('serial-numbers');
Route::get('/api/product-description', [ServiceController::class, 'getProductDescription'])->name('product-description');

Route::post('/form-service/store', [ServiceController::class, 'store'])->name('form-service.store');


// Admin
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/service/{category}', [AdminServiceController::class, 'byCategory'])->name('service.category');
    Route::post('/service/update-field', [AdminServiceController::class, 'updateField'])->name('service.updateField');
    Route::get('/service/{category}/export', [AdminServiceController::class, 'export'])->name('service.export');
    Route::post('/service/add-serial',   [AdminServiceController::class, 'addSerial'])->name('service.addSerial');
    Route::post('/service/update-serial', [AdminServiceController::class, 'updateSerial'])->name('service.updateSerial');
    Route::delete('/service/delete-serial/{id}', [AdminServiceController::class, 'deleteSerial'])->name('service.deleteSerial');
    Route::post('/service/{service}/add-sparepart', [AdminServiceController::class, 'addUsedSparePart'])->name('service.addSparepart');
    Route::delete('/service/{service}/remove-sparepart/{sparePart}', [AdminServiceController::class, 'removeUsedSparePart'])->name('service.removeSparepart');

    Route::resource('spare-parts', AdminSparePartController::class);
    Route::post('/spare-parts/{spare_part}/prices', [AdminSparePartController::class, 'storePrice'])->name('spare-parts.prices.store');
    Route::post('/spare-parts/{id}/restore', [AdminSparePartController::class, 'restore'])->name('spare-parts.restore');
    Route::get('/api/sparepart-codes', [AdminServiceController::class, 'getSparePartCodes'])->name('sparepart-codes');
});

