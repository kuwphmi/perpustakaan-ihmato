<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $query = $request->message;

        /*
        =========================================================
        1. AMBIL DATA BUKU DARI OPEN LIBRARY
        =========================================================
        */
        $olResponse = Http::get("https://openlibrary.org/search.json", [
            'q' => $query
        ]);

        $books = $olResponse->json()['docs'] ?? [];

        $bookList = collect($books)->take(5)->map(function ($book) {
            return [
                'title' => $book['title'] ?? '-',
                'author' => $book['author_name'][0] ?? '-',
                'year' => $book['first_publish_year'] ?? '-'
            ];
        });

        /*
        =========================================================
        2. SYSTEM PROMPT (INI YANG PALING PENTING)
        =========================================================
        */
        $context = "
Kamu adalah AI ASISTEN untuk APLIKASI PERPUSTAKAAN DIGITAL DAN TOKO BUKU.

ATURAN WAJIB:
1. Kamu berada dalam sistem yang MENYEDIAKAN PEMINJAMAN DAN PENJUALAN BUKU.
2. Jika user bertanya tentang membeli buku → jawab bahwa buku bisa dibeli di toko buku dalam aplikasi.
3. Jika user bertanya meminjam buku → jelaskan proses peminjaman di perpustakaan.
4. Jangan pernah bilang tidak menjual atau tidak memiliki fitur, karena sistem ini memang punya fitur tersebut.
5. Jawaban harus membantu user mencari, membeli, atau meminjam buku.

DAFTAR BUKU YANG TERSEDIA:
";

        /*
        =========================================================
        3. MASUKKAN DATA BUKU KE CONTEXT
        =========================================================
        */
        foreach ($bookList as $b) {
            $context .= "- {$b['title']} oleh {$b['author']} ({$b['year']})\n";
        }

        $context .= "\nPERTANYAAN USER: " . $query;

        /*
        =========================================================
        4. KIRIM KE GEMINI
        =========================================================
        */
        $apiKey = env('GEMINI_API_KEY');
        $model = "gemini-2.5-flash";
        $url = "https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-goog-api-key' => $apiKey
        ])->post($url, [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $context]
                    ]
                ]
            ]
        ]);

        /*
        =========================================================
        5. HANDLE ERROR
        =========================================================
        */
        if ($response->failed()) {
            return response()->json([
                "error" => "Gemini API gagal",
                "status" => $response->status(),
                "body" => $response->body()
            ], 500);
        }

        $data = $response->json();

        /*
        =========================================================
        6. RESPONSE KE FRONTEND
        =========================================================
        */
        return response()->json([
            "reply" => $data['candidates'][0]['content']['parts'][0]['text'] ?? null,
            "books" => $bookList
        ]);
    }
}