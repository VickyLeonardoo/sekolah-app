<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\StudentClass;
use App\Models\Teacher;
use App\Models\TeacherClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SchoolClass $schoolClass, $academicYear)
    {
        
        $academicYear = AcademicYear::find($academicYear);
        

        $teachers = Teacher::whereDoesntHave('teacher_classes', function ($query) use ($academicYear, $schoolClass) {
            $query->where('academic_year_id', $academicYear->id)
                  ->where('school_class_id', $schoolClass->id);
        })->get();

        if (!$academicYear) {
            $academicYear['id'] = null;
        }


        $current_teacher_classes = TeacherClass::where('school_class_id', $schoolClass->id)
            ->where('academic_year_id', $academicYear->id)
            ->first();

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
        $studentClass = StudentClass::where('school_class_id', $schoolClass->id)
                            ->where('academic_year_id', $academicYear->id)
                            ->get()
                            ->sortBy(function($studentClass) {
                                return $studentClass->student->name;  // Sorting by student's name
                            });

        return view('class.student', [
            'class' => $schoolClass,
            'studentClass' => $studentClass,
            'academicYear' => $academicYear,
            'students' => $students,
            'teachers' => $teachers,
            'currentTeacher' => $current_teacher_classes
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
    public function store(Request $request, $school_class, $academic_year)
    {
        $validatedData = $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:students,id'
        ]);

        $school_class = SchoolClass::find($school_class);
        $academic_year = AcademicYear::find($academic_year);
        // Hitung jumlah siswa yang sudah ada di kelas ini pada tahun akademik ini
        $current_students_count = StudentClass::where('school_class_id', $school_class->id)
            ->where('academic_year_id', $academic_year->id)
            ->count();

        // Hitung jumlah siswa baru yang ingin ditambahkan
        $new_students_count = count($validatedData['students']);
        // Cek apakah total siswa melebihi batas maksimal
        if (($current_students_count + $new_students_count) > $school_class->max_student) {
            // Kembalikan error dengan session
            return redirect()->back()->with('error', 
                "Penambahan siswa melebihi kapasitas maksimal kelas. " .
                "kelas hanya dapat menampung maksimal {$school_class->max_student} siswa."
            )->withInput();
        }


        // Mulai transaksi untuk menambahkan siswa
        DB::beginTransaction();

        try {
            $studentClassData = [];
            foreach ($validatedData['students'] as $studentId) {
                $existingAssignment = StudentClass::where('student_id', $studentId)
                    ->where('school_class_id', $school_class->id)
                    ->where('academic_year_id', $academic_year->id)
                    ->exists();

                if (!$existingAssignment) {
                    $studentClassData[] = [
                        'student_id' => $studentId,
                        'school_class_id' => $school_class->id,
                        'academic_year_id' => $academic_year->id,
                        'status' => null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            if (!empty($studentClassData)) {
                StudentClass::insert($studentClassData);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Siswa berhasil ditambahkan ke kelas');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding students to class: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan siswa ke kelas');
        }
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
        $studentClass->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus dari kelas');
    }
}
