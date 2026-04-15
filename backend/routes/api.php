<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;

Route::prefix('library')->group(function () {
    Route::get('/books', [LibraryController::class, 'books']);
});