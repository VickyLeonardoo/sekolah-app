<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\StudentFee;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\StudentClass;
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

        $getPromotedYear = AcademicYear::where('start_year',$academicYear->end_year)->first();
        if (!$getPromotedYear) {
            $getPromotedYear['id'] = null;
        }
        $getClass = SchoolClass::where('major_id',$schoolClass->major_id)->where('grade',$schoolClass->grade + 1)->get();
        $getClassDemot = SchoolClass::where('major_id',$schoolClass->major_id)->where('grade',$schoolClass->grade)->get();
        // return $getClassDemot;
        
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
            'currentTeacher' => $current_teacher_classes,
            'promotedYear' => $getPromotedYear,
            'promotedClass' => $getClass,
            'demotedClass' => $getClassDemot,
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
            'students.*' => 'exists:students,id',
        ]);

        $school_class = SchoolClass::findOrFail($school_class);
        $academic_year = AcademicYear::findOrFail($academic_year);

        // Hitung kapasitas siswa
        $current_students_count = StudentClass::where('school_class_id', $school_class->id)
            ->where('academic_year_id', $academic_year->id)
            ->count();

        $new_students_count = count($validatedData['students']);

        if (($current_students_count + $new_students_count) > $school_class->max_student) {
            return redirect()->back()->with('error', 
                "Penambahan siswa melebihi kapasitas maksimal kelas. " .
                "Kelas hanya dapat menampung maksimal {$school_class->max_student} siswa."
            )->withInput();
        }

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
                        'updated_at' => now(),
                    ];
                }
            }

            if (!empty($studentClassData)) {
                StudentClass::insert($studentClassData);
                $this->create_student_fee($academic_year->id, $studentClassData);
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
    public function destroy($student_id, $academic_year)
    {
        $studentClass = StudentClass::find($student_id);
        $academic_year = AcademicYear::find($academic_year);
        if ($studentClass) {
            $studentClass->delete();
            StudentFee::where('student_id',$studentClass->student_id)->where('academic_year_id',$academic_year->id)->delete();
        }
        return redirect()->back()->with('success', 'Siswa berhasil dihapus dari kelas');
    }

    public function set_promote($ids, $classId, $promotedYear)
    {
        // Cari kelas berdasarkan ID
        $school_class = SchoolClass::findOrFail($classId);
        
        // Cari tahun ajaran berdasarkan ID tahun ajaran yang akan dipromosikan
        $currentYear = AcademicYear::findOrFail($promotedYear);
    
        // Cari tahun ajaran baru berdasarkan akhir tahun ajaran sekarang
        $academic_year = AcademicYear::where('start_year', $currentYear->end_year)->first();
    
        if (!$academic_year) {
            return redirect()->back()->with('error', 'Tahun ajaran baru belum dibuat. Buat terlebih dahulu tahun ajaran yang baru.');
        }
    
        // Pastikan $ids adalah array
        $studentIds = is_array($ids) ? $ids : explode(',', $ids);
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Update status siswa menjadi 'Promoted'
            StudentClass::whereIn('id', $studentIds)->update(['status' => 'Promoted']);
    
            // Data baru untuk dimasukkan ke tabel StudentClass
            $studentClassData = [];
    
            // Query untuk memeriksa apakah siswa sudah ada di kelas baru
            $existingAssignments = StudentClass::whereIn('student_id', $studentIds)
                ->where('school_class_id', $school_class->id)
                ->where('academic_year_id', $academic_year->id)
                ->pluck('student_id')
                ->toArray();
    
            // Siapkan data untuk siswa yang belum ada di kelas baru
            foreach ($studentIds as $studentId) {
                if (!in_array($studentId, $existingAssignments)) {
                    $studentClassData[] = [
                        'student_id' => $studentId,
                        'school_class_id' => $school_class->id,
                        'academic_year_id' => $academic_year->id,
                        'status' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
    
            // Insert data siswa baru ke kelas baru jika ada
            if (!empty($studentClassData)) {
                StudentClass::insert($studentClassData);
    
                // Update grade siswa yang baru ditambahkan
                Student::whereIn('id', $studentIds)->update(['grade' => $school_class->grade]);
    
                // Ambil semua data StudentClass baru yang baru dimasukkan
                $newStudentClasses = StudentClass::where('academic_year_id', $academic_year->id)
                    ->whereIn('student_id', $studentIds)
                    ->get();
    
                // Buat student fee untuk siswa yang baru ditambahkan
                $this->create_student_fee($academic_year->id, $newStudentClasses);
            } else {
                DB::rollBack(); // Batalkan jika tidak ada siswa yang bisa ditambahkan
                return redirect()->back()->with('error', 'Tidak ada siswa yang dapat ditambahkan ke kelas baru.');
            }
    
            DB::commit(); // Commit transaksi jika semuanya berhasil
            return redirect()->back()->with('success', 'Status siswa berhasil diubah menjadi naik kelas.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            Log::error('Error promoting students: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mempromosikan siswa.');
        }
    }
    

    public function set_graduated($ids){
        $studentIds = explode(',', $ids); // Get array of IDs
        StudentClass::whereIn('id', $studentIds)->update(['status' => 'Graduated']);

        return redirect()->back()->with('success', 'Status siswa berhasil diubah menjadi Lulus');
    }

    public function set_demoted(Request $request, $ids, $classId, $promotedYear)
    {
        // Cari kelas berdasarkan ID
        $school_class = SchoolClass::findOrFail($classId);
    
        // Cari tahun ajaran berdasarkan ID tahun ajaran yang akan dipromosikan
        $currentYear = AcademicYear::findOrFail($promotedYear);
    
        // Cari tahun ajaran baru berdasarkan akhir tahun ajaran sekarang
        $academic_year = AcademicYear::where('start_year', $currentYear->end_year)->first();
    
        if (!$academic_year) {
            return redirect()->back()->with('error', 'Tahun ajaran baru belum dibuat. Buat terlebih dahulu tahun ajaran yang baru.');
        }
    
        // Pastikan $ids adalah array
        $studentIds = is_array($ids) ? $ids : explode(',', $ids);
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Update status siswa menjadi 'Retained' (ditahan)
            StudentClass::whereIn('id', $studentIds)->update(['status' => 'Retained']);
    
            // Data baru untuk dimasukkan ke tabel StudentClass
            $studentClassData = [];
    
            // Query untuk memeriksa apakah siswa sudah ada di kelas baru
            $existingAssignments = StudentClass::whereIn('student_id', $studentIds)
                ->where('school_class_id', $school_class->id)
                ->where('academic_year_id', $academic_year->id)
                ->pluck('student_id')
                ->toArray();
    
            // Siapkan data untuk siswa yang belum ada di kelas baru
            foreach ($studentIds as $studentId) {
                if (!in_array($studentId, $existingAssignments)) {
                    $studentClassData[] = [
                        'student_id' => $studentId,
                        'school_class_id' => $school_class->id,
                        'academic_year_id' => $academic_year->id,
                        'status' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
    
            // Insert data siswa baru ke kelas baru jika ada
            if (!empty($studentClassData)) {
                StudentClass::insert($studentClassData);
    
                // Update grade siswa yang baru ditambahkan
                Student::whereIn('id', $studentIds)->update(['grade' => $school_class->grade]);
    
                // Ambil semua data StudentClass baru yang baru dimasukkan
                $newStudentClasses = StudentClass::where('academic_year_id', $academic_year->id)
                    ->whereIn('student_id', $studentIds)
                    ->get();
    
                // Buat student fee untuk siswa yang baru ditambahkan
                $this->create_student_fee($academic_year->id, $newStudentClasses);
            } else {
                DB::rollBack(); // Batalkan jika tidak ada siswa yang bisa ditambahkan
                return redirect()->back()->with('error', 'Tidak ada siswa yang dapat ditambahkan ke kelas baru.');
            }
    
            DB::commit(); // Commit transaksi jika semuanya berhasil
            return redirect()->back()->with('success', 'Status siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            Log::error('Error demoting students: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status siswa.');
        }
    }
    

    public function create_student_fee($academic_year_id, $studentClassData)
    {
        $academicYear = AcademicYear::findOrFail($academic_year_id);

        $start_month = $academicYear->start_month;
        $end_month = $academicYear->end_month;
        $start_year = $academicYear->start_year;
        $end_year = $academicYear->end_year;

        $feeData = [];

        foreach ($studentClassData as $student) {
            $current_month = $start_month;
            $current_year = $start_year;

            while (true) {
                $feeData[] = [
                    'academic_year_id' => $academic_year_id,
                    'student_id' => $student['student_id'], // Sesuaikan key
                    'month_number' => $current_month,
                    'month_name' => $this->getMonthName($current_month),
                    'year' => $current_year,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if ($current_month == $end_month && $current_year == $end_year) {
                    break;
                }

                $current_month++;
                if ($current_month > 12) {
                    $current_month = 1;
                    $current_year++;
                }
            }
        }

        StudentFee::insert($feeData);
    }

    private function getMonthName($month_number)
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return $months[$month_number] ?? 'Unknown';
    }


}
