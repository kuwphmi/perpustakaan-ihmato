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

/* katalog*/
Route::get('/buku', [BukuJualController::class, 'index']);

/* HOME + FITUR UTAMA */
Route::get('/home', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/book/{title}', [HomeController::class, 'detail']);
Route::get('/riwayat', [HomeController::class, 'riwayat']);
Route::get('/genre/{name}', [HomeController::class, 'genre']);
Route::get('/checkout', [HomeController::class, 'checkout']);

Route::get('/wishlist', function () {
    $wishlist = session()->get('wishlist', []);
    return view('wishlist', compact('wishlist'));
});

Route::get('/wishlist/add', function (\Illuminate\Http\Request $request) {

    $book = [
        'title' => $request->title,
        'author' => $request->author,
        'cover' => $request->cover,
    ];

    $wishlist = session()->get('wishlist', []);
    $wishlist[] = $book;

    session()->put('wishlist', $wishlist);

    return redirect()->back();
});

/* NOTIFIKASI*/
Route::get('/notif', function () {
    $notif = session()->get('notif', []);
    return view('notif', compact('notif'));
});

