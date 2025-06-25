<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminServiceController;

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

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/service/{category}', [AdminServiceController::class, 'byCategory'])->name('admin.service.category');
    Route::post('/service/update-field', [AdminServiceController::class, 'updateField'])->name('admin.service.updateField');
    Route::get('/service/{category}/export', [AdminServiceController::class, 'export'])->name('admin.service.export');
});

