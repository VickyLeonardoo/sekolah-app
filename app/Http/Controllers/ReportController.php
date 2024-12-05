<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeeReportExport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('report.index');
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
        $request->validate([
            'grade' => 'required',
            'start_month' => 'required',
            'end_month' => 'required',
        ], [
            'grade.required' => 'Kelas wajib diisi',
            'start_month.required' => 'Tanggal awal wajib diisi',
            'end_month.required' => 'Tanggal akhir wajib diisi',
        ]);

        $startMonth = explode('-', $request->start_month)[1];
        $endMonth = explode('-', $request->end_month)[1];

        $students = Student::where('grade', $request->grade)
            ->with(['fee' => function ($query) use ($startMonth, $endMonth) {
                $query->whereBetween('month_number', [$startMonth, $endMonth])
                    ->where('is_paid', false);
            }])
            ->get()
            ->toArray();

        return Excel::download(new FeeReportExport($students), 'fee_report.xlsx');
    }


    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
