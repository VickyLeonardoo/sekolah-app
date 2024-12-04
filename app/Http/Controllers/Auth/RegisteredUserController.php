<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'identity_no' => ['required'],
            'phone' => ['required','numeric'],
        ]);

        $checkNisn = Student::where('identity_no', $request->identity_no)->first();
        if ($checkNisn) {
            if ($checkNisn->account_created > 3) {
                return redirect()->back()->with('error','Siswa tersebut sudah memiliki 3 akun. Gagal membuat akun');
            }
        }else{
            return redirect()->back()->with('error', 'Nomor Induk Siswa Nasional tidak ditemukan')->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'identity_no' => $request->identity_no,
            'phone' => $request->phone,
        ]);

        $checkNisn->account_created += 1;
        $checkNisn->save();

        $user->assignRole('parent');
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('client.dashboard.index', absolute: false));
    }
}
