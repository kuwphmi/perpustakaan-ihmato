<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BukuJualController;
use App\Http\Controllers\KeranjangController;

Route::prefix('library')->group(function () {
    Route::get('/books', [LibraryController::class, 'books']); });

Route::get('/buku', [BukuJualController::class, 'index']);
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);