<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeeReportExport;
use App\Models\AcademicYear;
use App\Models\SchoolClass;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::get();
        return view('report.index',[
            'classes' => $classes,
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
        $request->validate([
            'school_class_id' => 'required',
            'start_month' => 'required',
            'end_month' => 'required',
        ], [
            'school_class_id.required' => 'Kelas wajib diisi',
            'start_month.required' => 'Tanggal awal wajib diisi',
            'end_month.required' => 'Tanggal akhir wajib diisi',
        ]);

        $startMonth = explode('-', $request->start_month)[1];
        $endMonth = explode('-', $request->end_month)[1];

        $activeYear = AcademicYear::where('is_active', true)->first();

        if (!$activeYear) {
            return redirect()->back()->withErrors(['error' => 'Tahun akademik aktif tidak ditemukan.']);
        }

        // Ambil siswa yang memiliki fee yang sesuai kriteria
        $students = Student::whereHas('student_classes', function ($query) use ($request) {
                $query->where('school_class_id', $request->school_class_id);
            })
            ->whereHas('fee', function ($query) use ($startMonth, $endMonth, $activeYear) {
                $query->whereBetween('month_number', [$startMonth, $endMonth])
                    ->where('academic_year_id', $activeYear->id)
                    ->where('is_paid', false);
            })
            ->with(['fee' => function ($query) use ($startMonth, $endMonth, $activeYear) {
                $query->whereBetween('month_number', [$startMonth, $endMonth])
                    ->where('academic_year_id', $activeYear->id)
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
