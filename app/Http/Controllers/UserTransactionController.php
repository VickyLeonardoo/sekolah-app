<?php

namespace App\Http\Controllers;

use App\Mail\TransactionMail;
use App\Models\Student;
use App\Models\StudentFee;
use App\Models\Transaction;
use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);
        return view('front.transaction.index',[
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $existTransaction = Transaction::where('user_id',Auth::user()->id)->where('status','pending')->first();
        $active_academic_year = AcademicYear::where('is_active',true)->first();
        $student = Student::where('identity_no',Auth::user()->identity_no)->first();

        $student_fee = StudentFee::where('student_id',$student->id)->where('academic_year_id',$active_academic_year->id)->where('is_paid',false)->get();
        return view('front.transaction.create',[
            'academic_year' => $active_academic_year,
            'student_fee' => $student_fee,
            'existTransaction' => $existTransaction,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = Student::where('identity_no', Auth::user()->identity_no)->first();

        $academic_year = AcademicYear::where('is_active', true)->first();

        $data = $request->all();

        $amount_all = 0;
        
        // Hitung jumlah bulan yang dipilih
        $countFee = count($data['fee_id']);
        
        // Hitung total biaya
        $amount_all = $countFee * $academic_year->price;

        // Generate unique transaction_no
        do {
            $microtime = explode(' ', microtime());
            $transaction_no = 'TXN' . 
                            date('dmY') .  // tanggal, bulan, tahun
                            date('His') .  // jam, menit, detik
                            substr($microtime[0], 2, 4) . // 4 digit mikrodetik
                            str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT); // 4 digit random
        } while (Transaction::where('transaction_no', $transaction_no)->exists());

        $transaction = Transaction::create([
            'transaction_no' => $transaction_no,
            'student_id' => $student->id,
            'user_id' => Auth::user()->id,
            'amount' => $amount_all,
            'status' => 'Pending',
        ]);

        foreach ($data['fee_id'] as $fee) {
            UserTransaction::create([
                'transaction_id' => $transaction->id,
                'student_fee_id' => $fee,
            ]);
        }

        return redirect()->route('client.dashboard.index')->with('success', 'Formulir transaksi berhasil dibuat. Silahkan lakukan pembayaran dan lakukan upload bukti pembayaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $academic_year = AcademicYear::where('is_active', true)->first();
        $student_fee_transaction = UserTransaction::where('transaction_id',$transaction->id)->get();
        return view('front.transaction.show',[
            'transaction' => $transaction,
            'selectedMonths' => $student_fee_transaction,
            'academic_year' => $academic_year
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'proof_image' => ['required','mimes:png,jpg,pdf'],
        ],[
            'proof_image.required' => 'Wajib upload bukti pembayaran',
            'proof_image.mimes' => 'Format file tidak sesuai, format file yang diizinkan adalah png, jpg, pdf',
        ]);

        if ($request->hasFile('proof_image')) {
            if ($transaction->proof_image) {
                Storage::disk('public')->delete($transaction->proof_image);
            }

            $imagePath = $request->file('proof_image')->store('image-proof', 'public');
            $data['proof_image'] = $imagePath;
        }
        $transaction->update($data);

        $emails = User::role(['admin', 'superadmin'])->pluck('email');
        Mail::to($emails)->send(new TransactionMail($transaction));

        return redirect()->route('client.transaction.index')->with('success','Upload bukti pembayaran berhasil, menunggu konfirmasi pihak administrasi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTransaction $userTransaction)
    {
        //
    }

    public function set_cancel(Transaction $transaction){
        $transaction->update([
            'status' => 'cancelled'
        ]);

        return redirect()->route('client.transaction.index')->with('success','Transaksi berhasil dibatalkan');
    }
}
