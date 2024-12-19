<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar
        $transactions = Transaction::with(['student', 'user'])
            ->where('status', 'pending');

        // Jika ada pencarian
        if ($request->has('search') && $request->search) {
            $query = $request->search;

            $transactions = $transactions->where(function ($q) use ($query) {
                $q->where('transaction_no', 'like', "%{$query}%")
                ->orWhereHas('student', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('identity_no', 'like', "%{$query}%");
                })
                ->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            });
        }

        // Paginasi hasil query
        $transactions = $transactions->paginate(10);

        // Kirim data ke view
        return view('transaction.index', [
            'transactions' => $transactions
        ]);
    }

    public function history(Request $request){
        // / Query dasar
        $transactions = Transaction::with(['student', 'user'])
            ->whereIn('status', ['approved','cancelled','rejected']);

        // Jika ada pencarian
        if ($request->has('search') && $request->search) {
            $query = $request->search;

            $transactions = $transactions->where(function ($q) use ($query) {
                $q->where('transaction_no', 'like', "%{$query}%")
                ->orWhereHas('student', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('identity_no', 'like', "%{$query}%");
                })
                ->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            });
        }

        // Paginasi hasil query
        $transactions = $transactions->paginate(10);

        // Kirim data ke view
        return view('transaction.history', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $academic_year = AcademicYear::where('is_active',true)->first();
        $student_fee_transaction = UserTransaction::where('transaction_id',$transaction->id)->get();

        return view('transaction.show',[
            'transaction' => $transaction,
            'academic_year' => $academic_year,
            'selectedMonths' => $student_fee_transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function set_approved(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            // Update transaction status
            $transaction->update([
                'status' => 'approved'
            ]);

            // Update student fees for related user transactions
            $transaction->user_transaction()->each(function ($userTransaction) {
                $userTransaction->student_fee->update([
                    'is_paid' => true,
                ]);
            });
        });

        return redirect()
            ->route('transaction.index')
            ->with('success', 'Transaksi berhasil disetujui');
    }

    public function set_rejected(Request $request, Transaction $transaction){
        $request->validate([
            'description' => 'required',
        ]);

        $transaction->update([
            'status' => 'rejected',
            'description' => $request->description
        ]);
        return redirect()->route('transaction.index')->with('success','Transaksi berhasil ditolak');
    }

}
