<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
{
    // ambil data buku
    $response = Http::get('https://openlibrary.org/search.json?q=harry');

    $data = $response->json();

    $books = [];
    $subjects = [];

    foreach (array_slice($data['docs'] ?? [], 0, 10) as $item) {

        // buku
        $books[] = [
            'title' => $item['title'] ?? '-',
            'author' => $item['author_name'][0] ?? '-',
        ];

        // subjects dari API
        if (isset($item['subject'])) {
            foreach ($item['subject'] as $sub) {
                $category = "General"; // bisa kamu kembangkan nanti
                $subjects[$category][] = $sub;
            }
        }
    }

    return view('home', compact('books', 'subjects'));
}
}