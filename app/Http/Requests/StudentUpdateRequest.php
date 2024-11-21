<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        $studentId = $this->route('student'); // Ambil ID murid dari route

        return [
            'identity_no' => ['required',Rule::unique('users')->ignore($studentId)],
            'name' => ['required'],
            'dob' => ['required'],
            'gender' => ['required'],
            'religion' => ['required'],
            'phone' => ['sometimes'],
            'address' => ['required'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'father_phone' => ['sometimes'],
            'mother_phone' => ['sometimes'],
            'photo' => ['sometimes'],
            'major_id' => ['sometimes'],
        ];
    }

    public function messages(): array
    {
        return [
            'identity_no.required' => 'Nomor identitas wajib diisi.',
            'identity_no.unique' => 'Nomor identitas sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'dob.required' => 'Tanggal lahir wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib diisi.',
            'religion.required' => 'Agama wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'father_name.required' => 'Nama ayah wajib diisi.',
            'mother_name.required' => 'Nama ibu wajib diisi.',
            'major_id.required' => 'Jurusan wajib diisi',
        ];
    }
}
