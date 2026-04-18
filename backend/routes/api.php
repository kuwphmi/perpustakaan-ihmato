<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BukuJualController;

Route::prefix('library')->group(function () {
    Route::get('/books', [LibraryController::class, 'books']);
});

Route::get('/buku', [BukuJualController::class, 'index']);