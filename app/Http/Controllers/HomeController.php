<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Home;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\StudentFee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $student = Student::where('identity_no',Auth::user()->identity_no)->first();
        $upcomingPayment = StudentFee::where('student_id', $student->id)->where('is_paid', 'false')->count();
        $transaction = Transaction::where('user_id',Auth::user()->id)->where('status','approved')->count();
        return view('front.dashboard',[
            'student' => $student,
            'upcomingCount' => $upcomingPayment,
            'transactionCount' => $transaction,
        ]);
    }

    public function index_admin(){
        $todayTransactionsCount = Transaction::where('status', 'pending')
            ->whereDate('created_at', Carbon::today())
            ->whereNotNull('proof_image')
            ->count();

        $todayTransactions = Transaction::where('status', 'pending')
            ->whereDate('created_at', Carbon::today())
            ->whereNotNull('proof_image')
            ->paginate(10);

        $totalPendingTransactionCount = Transaction::where('status','pending')->whereNotNull('proof_image')->count();

        $studentsCount = Student::where('is_graduated', false)->count();

        $studentGraduateCount = Student::where('is_graduated', true)->count();
         return view('dashboard',[
             'studentsCount' => $studentsCount,
             'todayTransactionsCount' => $todayTransactionsCount,
             'totalPendingTransactionCount' => $totalPendingTransactionCount,
             'transactions' => $todayTransactions 
         ]);
    }

}
 