<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SchoolClass $schoolClass, $academicYear)
    {
        $academicYear = AcademicYear::find($academicYear);

        if (!$academicYear) {
            $academicYear['id'] = null;
        }

        $grade = $schoolClass->grade;
        $students = []; 
        if ($grade == 10) {
            $studentList = Student::where('grade','10')->with('major')->get();
            foreach ($studentList as $student) {
                if ($student->student_classes->isEmpty()) {
                    $students[] = $student; // Tambahkan siswa ke dalam daftar
                }
            }
        }
        $studentClass = StudentClass::where('school_class_id', $schoolClass->id)->where('academic_year_id',$academicYear->id)->get();
        return view('class.student',[
            'class' => $schoolClass,
            'studentClass' => $studentClass,
            'academicYear' => $academicYear,
            'students' => $students,
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
    public function show(StudentClass $studentClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentClass $studentClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentClass $studentClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentClass $studentClass)
    {
        //
    }
}
