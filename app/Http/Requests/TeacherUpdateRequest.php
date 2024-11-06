<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['superadmin','admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // Suggested code may be subject to a license. Learn more: ~LicenseLog:2398870928.
    // Suggested code may be subject to a license. Learn more: ~LicenseLog:2822780817.
    public function rules(): array
    {
        $teacherId = $this->route('teacher'); // Ambil ID guru dari route
        $userId = $teacherId->user_id; // Ambil ID user terkait dari model teacher

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($userId) // Mengabaikan pengguna yang sama saat memvalidasi email
            ],
            'identity_no' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($userId) // Mengabaikan pengguna yang sama saat memvalidasi nomor identitas
            ],
            'password' => [
                'nullable', // Nullable untuk update
                'string',
                'min:8'
            ],
            'phone' => ['required', 'string', 'max:20'],
            'photo' => ['sometimes', 'nullable', 'image', 'max:2048'], // Validasi foto
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'identity_no.required' => 'Nomor identitas wajib diisi.',
            'identity_no.string' => 'Nomor identitas harus berupa teks.',
            'identity_no.max' => 'Nomor identitas maksimal 255 karakter.',
            'identity_no.unique' => 'Nomor identitas sudah terdaftar.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }

}
