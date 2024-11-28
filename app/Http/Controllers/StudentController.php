<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::with('major');

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $students = $students->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('identity_no', 'like', "%{$query}%")
                ->orWhereHas('major', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            });
        }

        $students = $students->paginate(10);

        return view('student.index',[
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all();
        return view('student.create',[
            'majors' => $majors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('student-photo','public');
            $data['photo'] = $imagePath;
        }

        $student = Student::create($data);
        
        return redirect()->route('student.index')->with('success','Data siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('student.show',[
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $majors = Major::all();
        return view('student.edit',[
            'student' => $student,
            'majors' => $majors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            // Hapus gambar lama jika ada
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            // Simpan gambar baru
            $imagePath = $request->file('photo')->store('student-photo', 'public');
            $data['photo'] = $imagePath;
        }
        
        $student->update($data);
        return redirect()->route('student.show',$student)->with('success','Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success','Data siswa berhasil dihapus');
    }

    public function show_import(){
        return view('student.import');
    }

    public function process_import(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $checkExtension =  $request->file('file')->getClientOriginalExtension();
        if ($checkExtension != 'csv' && $checkExtension != 'xlsx') {
            return redirect()->back()->withErrors('Format file salah, periksa format file yang kamu masukkan. Format file yang diizinkan adalah .XLSX/.CSV');
        }
        try {
            // Proses import
            Excel::import(new StudentsImport, $request->file('file'));
    
            return redirect()->back()->with('success', 'Students imported successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error Integrity Constraint Violation
            if ($e->errorInfo[1] == 1062) { // Kode error untuk Duplicate Entry
                return redirect()->back()->withErrors([
                    'Import gagal, terdapat NISN yang sama pada data.',
                ]);
            }
    
            // Tangkap error SQL lainnya
            return redirect()->back()->withErrors([
                'Import gagal: ' . $e->getMessage(),
            ]);
        } catch (\Throwable $e) {
            // Tangkap error lainnya
            return redirect()->back()->withErrors([
                'Import gagal: ' . $e->getMessage(),
            ]);
        }
    }

    public function information(Request $request)
    {
        $student = [];
        if ($request->has('identity_no')) {
            $student = Student::with('major')
                ->where('identity_no', $request->identity_no)
                ->first();
            if (!$student) {
                return redirect()->back()->with('error', 'Data siswa tidak ditemukan, periksa kembali NISN')->withInput();
            }
            return view('student.information', [
                'student' => $student
            ]);
        }else{
            return view('student.information');
        }
    }

}
