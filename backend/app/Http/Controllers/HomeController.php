<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get("https://openlibrary.org/search.json?q=programming");
        $data = $response->json();

        $books = $data['docs'] ?? [];

        // BEST
        $bestBooks = [];
        foreach (array_slice($books, 0, 10) as $item) {
            $bestBooks[] = [
                'title' => $item['title'] ?? '-',
                'author' => $item['author_name'][0] ?? '-',
                'cover' => $item['cover_i'] ?? null,
            ];
        }

        // TERBARU
        usort($books, function ($a, $b) {
            return ($b['first_publish_year'] ?? 0) <=> ($a['first_publish_year'] ?? 0);
        });

        $newBooks = [];
        foreach (array_slice($books, 0, 10) as $item) {
            $newBooks[] = [
                'title' => $item['title'] ?? '-',
                'author' => $item['author_name'][0] ?? '-',
                'cover' => $item['cover_i'] ?? null,
            ];
        }

        // GENRE
$genres = [
    'Art',
    'Science Fiction',
    'Fantasy',
    'Biographies',
    'Recipes',
    'Romance',
    'Textbooks',
    'Children',
    'Medicine',
    'Religion',
    'Mystery and Detective',
    'Plays',
    'Music',
    'Science'
];

// kalau kosong, kasih default biar tetap tampil
if (empty($genres)) {
    $genres = ['Fiction', 'Romance', 'Science', 'History', 'Technology'];
}

$genres = array_slice(array_unique($genres), 0, 10);

        return view('home', compact('bestBooks', 'newBooks', 'genres'));
    }

    public function search(Request $request)
    {
        $q = $request->query('q', '');

        if ($q == '') {
            return redirect('/home');
        }

        $response = Http::get("https://openlibrary.org/search.json?q=" . urlencode($q));
        $data = $response->json();

        $results = [];

        foreach ($data['docs'] ?? [] as $item) {
            $results[] = [
                'title' => $item['title'] ?? '-',
                'author' => $item['author_name'][0] ?? '-',
                'cover' => $item['cover_i'] ?? null,
            ];
        }

        return view('search', compact('results', 'q'));
    }

 public function detail($title, Request $request)
{
    $from = $request->query('from', 'home');
    $genre = $request->query('genre', null);

    $response = Http::get("https://openlibrary.org/search.json?q=" . urlencode($title));
    $data = $response->json();

    $book = null;

    if (!empty($data['docs'])) {
        $item = $data['docs'][0];

        $book = [
            'title' => $item['title'] ?? '-',
            'author' => $item['author_name'][0] ?? '-',
            'year' => $item['first_publish_year'] ?? '-',
            'cover' => $item['cover_i'] ?? null,
            'subject' => $item['subject'][0] ?? 'Tidak ada deskripsi'
        ];
    }

    return view('detail', compact('book', 'from', 'genre'));
}
public function riwayat()
{
    // 🔥 sementara dummy dulu
    $history = [
        [
            'title' => 'Harry Potter',
            'author' => 'J.K Rowling',
            'date' => '2026-04-10',
            'status' => 'Dipinjam'
        ],
        [
            'title' => 'Naruto',
            'author' => 'Masashi Kishimoto',
            'date' => '2026-04-05',
            'status' => 'Selesai'
        ]
    ];

    return view('riwayat', compact('history'));
}
public function genre($name)
{
    $response = Http::get('https://openlibrary.org/search.json', [
        'q' => $name
    ]);

    $data = $response->json();
    $books = $data['docs'] ?? [];

    return view('genre', compact('books', 'name'));
}
function addNotif($message)
{
    $notif = session()->get('notif', []);
    $notif[] = [
        'message' => $message,
        'time' => now()->format('d M Y H:i')
    ];

    session()->put('notif', $notif);
}
}