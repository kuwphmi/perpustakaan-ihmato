<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // SET MIDTRANS CONFIG (PAKAI IMPORT, BUKAN \Midtrans\)
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // ORDER ID unik
        $orderId = 'ORDER-' . time();

        // PARAMETER TRANSAKSI
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) ($request->amount ?? 10000),
            ],
            'customer_details' => [
                'first_name' => $request->name ?? 'User',
                'email' => $request->email ?? 'user@mail.com',
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'status' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}