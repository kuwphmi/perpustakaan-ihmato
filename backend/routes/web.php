<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuJualController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// halaman buku jual (API / listing buku)
Route::get('/buku', [BukuJualController::class, 'index']);

// halaman home dari teman kamu
Route::get('/home', [HomeController::class, 'index']);