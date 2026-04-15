<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LibraryController extends Controller
{
    public function books(Request $request)
    {
        $q = $request->query('q', 'harry potter');

        $response = Http::get("https://openlibrary.org/search.json?q=" . urlencode($q));

        $data = $response->json();

        $books = [];

        foreach ($data['docs'] ?? [] as $item) {
            $books[] = [
                'title' => $item['title'] ?? '-',
                'author' => $item['author_name'][0] ?? '-',
                'year' => $item['first_publish_year'] ?? '-',
            ];
        }

        return response()->json([
            "test" => "controller kepanggil",
            "data" => $books
]);    }
}