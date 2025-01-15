<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorStoreRequest;
use App\Http\Requests\MajorUpdateRequest;
use App\Models\Major;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class MajorController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $majors = Major::query(); // Inisialisasi query

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $majors = $majors->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('code', 'like', "%{$query}%");

            });
        }

        // Pagination 10 item per halaman
        $majors = $majors->paginate(10);

        return view('major.index',[
            'majors' => $majors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorStoreRequest $request)
    {

        $data = $request->validated();
        $major = Major::create($data);

        return redirect()->route('major.index')->with('success','Berhasil menambah data jurusan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        //
        return view('major.show', [
            'major' => $major
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        //
        return view('major.edit', [
            'major' => $major
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MajorUpdateRequest $request, Major $major)
    {
        $data = $request->validated();
        $major->update($data);
        $major->save();

        return redirect()->route('major.index')->with('success','Berhasil mengubah data jurusan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $checkClass = SchoolClass::where('major_id',$major->id)->first();
        if ($checkClass) {
            return redirect()->route('major.index')->with('error','Jurusan tidak bisa dihapus karena masih memiliki kelas');
        }else{
            $major->delete();
            return redirect()->route('major.index')->with('success','Berhasil menghapus data jurusan');
        }
        
    }
}
