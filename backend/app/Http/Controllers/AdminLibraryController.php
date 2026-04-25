<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminLibraryController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'total_loans' => DB::table('loan_requests')->where('status', 'approved')->count(),
            'total_members' => DB::table('members')->count(),
            'total_returns' => DB::table('loan_requests')->whereNotNull('returned_at')->count(),
            'total_requests' => DB::table('loan_requests')->count(),
        ]);
    }

    public function loans()
    {
        return DB::table('loan_requests')
            ->leftJoin('members', 'loan_requests.member_id', '=', 'members.id')
            ->leftJoin('books', 'loan_requests.book_id', '=', 'books.id')
            ->select(
                'loan_requests.id',
                'members.name as member_name',
                'books.title as book_title',
                'loan_requests.request_date',
                'loan_requests.due_date',
                'loan_requests.status'
            )
            ->where('loan_requests.status', 'approved')
            ->orderByDesc('loan_requests.id')
            ->get();
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
        $data = DB::table('loan_requests')
            ->leftJoin('members', 'loan_requests.member_id', '=', 'members.id')
            ->leftJoin('books', 'loan_requests.book_id', '=', 'books.id')
            ->select(
                'loan_requests.id',
                'members.name as member_name',
                'books.title as book_title',
                'loan_requests.returned_at',
                'loan_requests.due_date',
                'loan_requests.status'
            )
            ->whereNotNull('loan_requests.returned_at')
            ->orderByDesc('loan_requests.id')
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

        public function storeLoanRequest(Request $request)
        {
            $validated = $request->validate([
                'member_id' => 'required|integer',
                'book_id' => 'required|integer',
            ]);

            $existsBook = DB::table('books')->where('id', $validated['book_id'])->exists();
            $existsMember = DB::table('members')->where('id', $validated['member_id'])->exists();

            if (!$existsBook || !$existsMember) {
                return response()->json(['message' => 'Data tidak valid'], 400);
            }

            DB::table('loan_requests')->insert([
                'member_id' => $validated['member_id'],
                'book_id' => $validated['book_id'],
                'request_date' => now(),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Request berhasil']);
        }
    public function approveLoanRequest($id)
    {
        $check = DB::table('loan_requests')
        ->where('id', $id)
        ->where('status', 'pending')
        ->exists();

    if (!$check) {
        return response()->json(['message' => 'Invalid status'], 400);
    }

    DB::table('loan_requests')
        ->where('id', $id)
        ->update([
            'status' => 'approved',
            'due_date' => now()->addDays(7),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Disetujui']);
    }

    public function extensionRequests()
    {
        $data = DB::table('extension_requests')
            ->leftJoin('loan_requests', 'extension_requests.loan_id', '=', 'loan_requests.id')
            ->leftJoin('members', 'loan_requests.member_id', '=', 'members.id')
            ->leftJoin('books', 'loan_requests.book_id', '=', 'books.id')
            ->select(
                'extension_requests.id',
                'members.name as member_name',
                'books.title as book_title',
                'extension_requests.old_due_date',
                'extension_requests.new_due_date',
                'extension_requests.reason',
                'extension_requests.status',
                'extension_requests.loan_id'
            )
            ->orderByDesc('extension_requests.id')
            ->get();

        return response()->json($data);
    }

    public function storeExtensionRequest(Request $request)
{
    $validated = $request->validate([
        'loan_id' => 'required|integer',
        'new_due_date' => 'required|date',
        'reason' => 'nullable|string'
    ]);

    $loan = DB::table('loan_requests')
        ->where('id', $validated['loan_id'])
        ->first();

    if (!$loan) {
        return response()->json(['message' => 'Loan tidak ditemukan'], 404);
    }

    if ($loan->status !== 'approved') {
    return response()->json(['message' => 'Pinjaman belum aktif'], 400);
}

DB::table('extension_requests')->insert([
    'loan_id' => $validated['loan_id'],
    'old_due_date' => $loan->due_date,
    'new_due_date' => $validated['new_due_date'],
    'reason' => $validated['reason'],
    'status' => 'pending',
    'created_at' => now(),
    'updated_at' => now(),
]);

    return response()->json(['message' => 'Request terkirim']);
}

 public function approveExtension($id)
{
    $ext = DB::table('extension_requests')
        ->where('id', $id)
        ->first();

    if (!$ext) {
        return response()->json(['message' => 'Not found'], 404);
    }

    if ($ext->status !== 'pending') {
        return response()->json(['message' => 'Sudah diproses'], 400);
    }

    $loan = DB::table('loan_requests')
        ->where('id', $ext->loan_id)
        ->first();

    if (!$loan) {
        return response()->json(['message' => 'Loan tidak ditemukan'], 404);
    }

    if (($loan->extend_count ?? 0) >= 5) {
    return response()->json([
        'message' => 'Sudah mencapai maksimal 5 kali perpanjangan'
    ], 400);
}

DB::table('loan_requests')
    ->where('id', $ext->loan_id)
    ->update([
        'due_date' => $ext->new_due_date,
        'extend_count' => ($loan->extend_count ?? 0) + 1,
        'updated_at' => now(),
    ]);

    DB::table('extension_requests')
        ->where('id', $id)
        ->update([
            'status' => 'approved',
            'updated_at' => now(),
        ]);

    return response()->json([
        'message' => 'Perpanjangan disetujui'
    ]);
}

    public function monthlyReportPdf(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $loans = DB::table('loan_requests')
            ->leftJoin('members', 'loan_requests.member_id', '=', 'members.id')
            ->leftJoin('books', 'loan_requests.book_id', '=', 'books.id')
            ->select(
                'members.name as member_name',
                'books.title as book_title',
                'loan_requests.request_date',
                'loan_requests.returned_at',
                'loan_requests.status'
            )
            ->whereMonth('loan_requests.request_date', $month)
            ->whereYear('loan_requests.request_date', $year)
            ->get();

        $pdf = Pdf::loadView('report.monthly', [
            'loans' => $loans,
            'month' => $month,
            'year' => $year
        ]);

        return $pdf->stream("laporan-$month-$year.pdf");
    }

   public function printLoans()
    {
        $loans = DB::table('loan_requests')
            ->leftJoin('members', 'loan_requests.member_id', '=', 'members.id')
            ->leftJoin('books', 'loan_requests.book_id', '=', 'books.id')
            ->select(
                'members.name as member_name',
                'books.title as book_title',
                'loan_requests.request_date',
                'loan_requests.status'
            )
            ->get();

        $pdf = Pdf::loadView('pdf.loans', compact('loans'));

        return $pdf->download('data-pinjaman.pdf');
    }
}