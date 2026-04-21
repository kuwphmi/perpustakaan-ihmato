<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function tambah(Request $request)
    {
        try {

            $data = DB::table('keranjang')
                ->where('id_pengguna', $request->id_pengguna)
                ->where('id_buku', $request->id_buku)
                ->first();

            if ($data) {
                DB::table('keranjang')
                    ->where('id', $data->id)
                    ->increment('jumlah', 1);
            } else {
                DB::table('keranjang')->insert([
                    'id_pengguna' => $request->id_pengguna,
                    'id_buku' => $request->id_buku,
                    'judul' => $request->judul,
                    'gambar' => $request->gambar,
                    'harga' => $request->harga,
                    'jumlah' => 1
                ]);
            }

            return response()->json([
                'message' => 'Berhasil ditambahkan ke keranjang'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}