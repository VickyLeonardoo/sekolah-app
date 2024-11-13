<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Requests\ClassStoreRequest;
use App\Http\Requests\ClassUpdateRequest;

class SchoolClassController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize query with eager loading of 'major' relationship
        $classes = SchoolClass::with('major');

        if ($request->has('search')) {
            $query = $request->search;
            // Add search conditions for 'name' in SchoolClass and 'name' in Major
            $classes = $classes->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhereHas('major', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            });
        }

        // Paginate with 10 items per page
        $classes = $classes->paginate(10);

        return view('class.index', [
            'classes' => $classes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all();
        return view('class.create',[
            'majors' => $majors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassStoreRequest $request)
    {
        $data = $request->validated();

        $class = SchoolClass::create($data);

        return redirect()->route('school-class.index')->with('success','Data kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass)
    {
        return view('class.show', [
            'class' => $schoolClass
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolClass $schoolClass)
    {
        $majors = Major::all();
        return view('class.edit', [
            'class' => $schoolClass,
            'majors' => $majors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassUpdateRequest $request, SchoolClass $schoolClass)
    {
        $data = $request->validated();

        $schoolClass->update($data);

        return redirect()->route('school-class.show',$schoolClass)->with('success','Data kelas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
        return redirect()->route('school-class.index')->with('success','Data kelas berhasil dihapus');
    }
}
