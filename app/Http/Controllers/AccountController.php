<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query(); // Inisialisasi query

        // Filter hanya user dengan 'is_internal' = true
        $users = $users->where('is_internal', true);

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $query = $request->search;

            // Tambahkan pencarian pada kolom 'name', 'identity_no', 'email', dan 'position'
            $users = $users->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('identity_no', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('position', 'like', "%{$query}%");
            });
        }

        // Pagination 10 item per halaman
        $users = $users->paginate(10);

        return view('account.index', [
            'users' => $users,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $data = $request->validated();
       

        if ($request->role == 'principal') {
            $checkExistsPrincipal = User::whereHas('roles', function ($query) {
                $query->where('name', 'principal');
            })->first();
            if ($checkExistsPrincipal) {
                return redirect()->back()->withErrors('Gagal, tidak dapat membuat lebih dari satu akun kepala sekolah. Arsipkan terlebih dahulu akun yang telah ada')->withInput();
            }
        }
       
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['identity_no']),
            'identity_no' => $data['identity_no'],
            'phone' => $data['phone'],
            'position' => $data['position'],
            'is_internal' => true,
        ]);

        $user->assignRole($data['role']);

        return redirect()->route('account.index')->with('success','Berhasil menambahkan data akun');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $account)
    {
        return view('account.show',[
            'user' => $account
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $account)
    {
        $roleName = $account->getRoleNames();
        return view('account.edit',[
            'user' => $account,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountUpdateRequest $request, User $account)
    {
        $validated = $request->validated(); // Mengambil data yang telah divalidasi.

        if ($request->role == 'principal') {
            $checkExistsPrincipal = User::whereHas('roles', function ($query) {
                $query->where('name', 'principal');
            })
            ->where('id', '!=', $account->id) // Kecualikan pengguna yang sedang diupdate
            ->first();

            if ($checkExistsPrincipal) {
                return redirect()->back()->withErrors('Gagal, tidak dapat membuat lebih dari satu akun kepala sekolah. Arsipkan terlebih dahulu akun yang telah ada')->withInput();
            }
        }

        $account->update($validated);

        return redirect()->back()->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
