<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BukuJualController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminLibraryController;

Route::prefix('library')->group(function () {
    Route::get('/books', [LibraryController::class, 'books']); });

Route::get('/buku', [BukuJualController::class, 'index']);
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/checkout', [CheckoutController::class, 'index']);
Route::get('/books', [LibraryController::class, 'books']);

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminLibraryController::class, 'dashboard']);
    Route::get('/loans', [AdminLibraryController::class, 'loans']);
    Route::get('/members', [AdminLibraryController::class, 'members']);
    Route::get('/returns', [AdminLibraryController::class, 'returns']);

    Route::get('/loan-requests', [AdminLibraryController::class, 'loanRequests']);
    Route::post('/loan-requests', [AdminLibraryController::class, 'storeLoanRequest']);
    Route::post('/loan-requests/{id}/approve', [AdminLibraryController::class, 'approveLoanRequest']);

    Route::get('/extension-requests', [AdminLibraryController::class, 'extensionRequests']);
    Route::post('/extension-requests', [AdminLibraryController::class, 'storeExtensionRequest']);
    Route::post('/extension-requests/{id}/approve', [AdminLibraryController::class, 'approveExtensionRequest']);
});
