<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class BukuJualController extends Controller
{
    public function index(Request $request)
    {
        // 📚 1. Ambil data dari Open Library
        $response = Http::get("https://openlibrary.org/search.json", [
            'q' => $request->q ?? 'harry potter'
        ]);

        $data = $response->json();

        // 🛒 2. Ambil data tambahan dari Supabase
        $hargaData = DB::table('buku_jual')->get();

        $books = [];

        foreach ($data['docs'] ?? [] as $item) {

            // cocokkan data berdasarkan title
            $extra = collect($hargaData)
                ->firstWhere('title', $item['title']);

            $books[] = [
                'title' => $item['title'] ?? '-',
                'author' => $item['author_name'][0] ?? '-',
                'year' => $item['first_publish_year'] ?? '-',

                // 🖼 COVER GAMBAR
                'cover' => isset($item['cover_i'])
                    ? "https://covers.openlibrary.org/b/id/{$item['cover_i']}-L.jpg"
                    : "https://via.placeholder.com/150",

                // 🛒 DATA DARI SUPABASE
                'price' => $extra->price ?? 0,
                'stock' => $extra->stock ?? 0,
            ];
        }

        return view('BukuJual', compact('books'));
    }
}