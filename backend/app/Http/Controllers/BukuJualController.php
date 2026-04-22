<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class BukuJualController extends Controller
{
    public function index(Request $request)
    {
        // 📚 daftar genre
        $genres = [
            'fantasy',
            'romance',
            'science_fiction',
            'mystery',
            'horror',
            'history'
        ];

        // 🛒 ambil data dari database
        $hargaData = DB::table('buku_jual')->get();

        $booksByGenre = [];

        foreach ($genres as $g) {

            try {
                $response = Http::timeout(5)
                    ->get("https://openlibrary.org/subjects/{$g}.json?limit=8");

                $data = $response->json();

            } catch (\Exception $e) {
                continue;
            }

            foreach ($data['works'] ?? [] as $item) {

                // ambil data tambahan dari DB
                $extra = collect($hargaData)
                    ->firstWhere('title', $item['title']);

                $booksByGenre[ucwords(str_replace('_',' ', $g))][] = [
                    'title' => $item['title'] ?? '-',
                    'author' => $item['authors'][0]['name'] ?? '-',
                    'cover' => isset($item['cover_id'])
                        ? "https://covers.openlibrary.org/b/id/{$item['cover_id']}-L.jpg"
                        : "https://via.placeholder.com/150",
                    'price' => $extra->price ?? 50000,
                    'stock' => $extra->stock ?? 10,
                ];
            }
        }

        return view('BukuJual', compact('booksByGenre'));
    }
}