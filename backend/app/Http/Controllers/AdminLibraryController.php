<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminLibraryController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'total_loans' => DB::table('loans')->count(),
            'total_members' => DB::table('members')->count(),
            'total_returns' => DB::table('returns')->count(),
            'total_requests' => DB::table('loan_requests')->count() + DB::table('extension_requests')->count(),
        ]);
    }

    public function loans()
    {
        $data = DB::table('loans')
            ->leftJoin('members', 'loans.member_id', '=', 'members.id')
            ->leftJoin('books', 'loans.book_id', '=', 'books.id')
            ->select(
                'loans.id',
                'members.name as member_name',
                'books.title as book_title',
                'loans.loan_date',
                'loans.due_date',
                'loans.status'
            )
            ->orderByDesc('loans.id')
            ->get();

        return response()->json($data);
    }

    public function members()
    {
        $data = DB::table('members')
            ->select('id', 'name', 'member_code', 'phone', 'status')
            ->orderByDesc('id')
            ->get();

        return response()->json($data);
    }

    public function returns()
    {
        $data = DB::table('returns')
            ->leftJoin('members', 'returns.member_id', '=', 'members.id')
            ->leftJoin('books', 'returns.book_id', '=', 'books.id')
            ->select(
                'returns.id',
                'members.name as member_name',
                'books.title as book_title',
                'returns.return_date',
                'returns.fine'
            )
            ->orderByDesc('returns.id')
            ->get();

        return response()->json($data);
    }

    public function loanRequests()
    {
        $data = DB::table('loan_requests')
            ->leftJoin('members', 'loan_requests.member_id', '=', 'members.id')
            ->leftJoin('books', 'loan_requests.book_id', '=', 'books.id')
            ->select(
                'loan_requests.id',
                'members.name as member_name',
                'books.title as book_title',
                'loan_requests.request_date',
                'loan_requests.status'
            )
            ->orderByDesc('loan_requests.id')
            ->get()
            ->map(function ($row) {
                $row->_type = 'loan_request';
                return $row;
            });

        return response()->json($data);
    }

    public function extensionRequests()
    {
        $data = DB::table('extension_requests')
            ->leftJoin('loans', 'extension_requests.loan_id', '=', 'loans.id')
            ->leftJoin('members', 'loans.member_id', '=', 'members.id')
            ->leftJoin('books', 'loans.book_id', '=', 'books.id')
            ->select(
                'extension_requests.id',
                'members.name as member_name',
                'books.title as book_title',
                'extension_requests.old_due_date',
                'extension_requests.new_due_date',
                'extension_requests.status'
            )
            ->orderByDesc('extension_requests.id')
            ->get()
            ->map(function ($row) {
                $row->_type = 'extension_request';
                return $row;
            });

        return response()->json($data);
    }

    public function storeLoanRequest(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer',
            'book_id' => 'required|integer',
            'loan_date' => 'required|date',
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        DB::table('loan_requests')->insert([
            'member_id' => $validated['member_id'],
            'book_id' => $validated['book_id'],
            'request_date' => Carbon::now(),
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Pengajuan peminjaman berhasil disimpan.'], 201);
    }

    public function approveLoanRequest($id)
    {
        $requestData = DB::table('loan_requests')->where('id', $id)->first();

        if (!$requestData) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        DB::table('loan_requests')
            ->where('id', $id)
            ->update([
                'status' => 'approved',
                'updated_at' => now(),
            ]);

        DB::table('loans')->insert([
            'member_id' => $requestData->member_id,
            'book_id' => $requestData->book_id,
            'loan_date' => Carbon::now()->toDateString(),
            'due_date' => Carbon::now()->addDays(7)->toDateString(),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Pengajuan disetujui.']);
    }

    public function storeExtensionRequest(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|integer',
            'new_due_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        $loan = DB::table('loans')->where('id', $validated['loan_id'])->first();

        if (!$loan) {
            return response()->json(['message' => 'Loan tidak ditemukan.'], 404);
        }

        DB::table('extension_requests')->insert([
            'loan_id' => $validated['loan_id'],
            'old_due_date' => $loan->due_date,
            'new_due_date' => $validated['new_due_date'],
            'reason' => $validated['reason'] ?? null,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Pengajuan perpanjangan berhasil disimpan.'], 201);
    }

    public function approveExtensionRequest($id)
    {
        $ext = DB::table('extension_requests')->where('id', $id)->first();

        if (!$ext) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        DB::table('extension_requests')
            ->where('id', $id)
            ->update([
                'status' => 'approved',
                'updated_at' => now(),
            ]);

        DB::table('loans')
            ->where('id', $ext->loan_id)
            ->update([
                'due_date' => $ext->new_due_date,
                'updated_at' => now(),
            ]);

        return response()->json(['message' => 'Perpanjangan disetujui.']);
    }
}