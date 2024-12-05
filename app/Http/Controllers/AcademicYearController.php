<?php

namespace App\Http\Controllers;

use App\Http\Requests\YearStoreRequest;
use App\Http\Requests\YearUpdateRequest;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $years = AcademicYear::query(); // Inisialisasi query

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $years = $years->where(function ($q) use ($query) {
                $q->where('start_year', 'like', "%{$query}%")
                ->orWhere('end_year', 'like', "%{$query}%")
                ->orWhere('end_month', 'like', "%{$query}%")
                ->orWhere('start_month', 'like', "%{$query}%");

            });
        }

        // Pagination 10 item per halaman
        $years = $years->paginate(10);

        return view('academic-years.index',[
            'academicYears' => $years
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic-years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(YearStoreRequest $request)
    {
        $data = $request->validated();
        
        $checkYear = AcademicYear::where('start_year',$data['start_year'])->first();
        if ($checkYear) {
            return redirect()->back()->withErrors('start_year','Tahun ajaran sudah ada')->withInput();
        }

        if ($data['start_month'] == $data['end_month']) {
            return redirect()->back()->withErrors('start_month','bulan awal dan akhir tidak boleh sama')->withInput();
        }

        AcademicYear::create($data);

        return redirect()->route('academic-year.index')->with('success','Berhasil menambahkan data tahun ajaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        return view('academic-years.edit', [
            'academicYear' => $academicYear
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(YearUpdateRequest $request, AcademicYear $academicYear)
    {
        $data = $request->validated();
        $checkActiveYear = AcademicYear::where('is_active',true)->first();
        if ($data['is_active'] == '1') {
            if ($checkActiveYear && $checkActiveYear->id != $academicYear->id) {
                return redirect()->back()->with('is_active','Tahun ajaran aktif sudah ada')->withInput();
            }
        }

        $checkYear = AcademicYear::where('start_year',$data['start_year'])->where('id', '!=', $academicYear->id)->first();
        if ($checkYear) {
            return redirect()->back()->withErrors('start_year','Tahun ajaran sudah ada')->withInput();
        }

        $academicYear->update($data);

        return redirect()->route('academic-year.index')->with('success','Data tahun ajaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        //
    }
}
