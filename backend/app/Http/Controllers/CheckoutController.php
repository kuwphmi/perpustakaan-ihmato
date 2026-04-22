<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // SET MIDTRANS CONFIG
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // ORDER ID unik
        $orderId = 'ORDER-' . time();

        // PARAMETER TRANSAKSI
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->amount ?? 10000,
            ],
            'customer_details' => [
                'first_name' => $request->name ?? 'User',
                'email' => $request->email ?? 'user@mail.com',
            ]
        ];

        try {
            // CREATE SNAP TOKEN
            $snapToken = \Midtrans\Snap::getSnapToken($params);

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