<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BukuJualController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;



Route::prefix('library')->group(function () {
    Route::get('/books', [LibraryController::class, 'books']); });

Route::get('/buku', [BukuJualController::class, 'index']);
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/checkout', [CheckoutController::class, 'index']);