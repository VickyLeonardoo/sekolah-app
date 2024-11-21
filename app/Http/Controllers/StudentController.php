<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;
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
        //
    }
}
