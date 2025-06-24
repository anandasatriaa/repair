<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form-service', [ServiceController::class, 'index'])->name('form-service');
Route::get('/api/serial-numbers', [ServiceController::class, 'getSerialNumbers'])->name('serial-numbers');
Route::get('/api/product-description', [ServiceController::class, 'getProductDescription'])->name('product-description');

Route::post('/form-service/store', [ServiceController::class, 'store'])->name('form-service.store');
