<?php

namespace App\Http\Controllers;

use App\Models\TeacherClass;
use Illuminate\Http\Request;

class TeacherClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = [
            'teacher_id' => $request->teacher_id,
            'school_class_id' => $request->school_class_id,
            'academic_year_id' => $request->academic_year_id,
        ];

        $findOldTeahcer = TeacherClass::where('school_class_id', $request->school_class_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->first();

        if ($findOldTeahcer) {
            $findOldTeahcer->delete();
            TeacherClass::create($data);
            return redirect()->back()->with('success','Berhasil mengubah data wali kelas');
        }else{
            TeacherClass::create($data);
            return redirect()->back()->with('success','Berhasil menambahkan data wali kelas');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherClass $teacherClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherClass $teacherClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeacherClass $teacherClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeacherClass $teacherClass)
    {
        //
    }
}
