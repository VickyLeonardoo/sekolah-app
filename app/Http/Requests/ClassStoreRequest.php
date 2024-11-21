<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassStoreRequest extends FormRequest
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
        return [
            'name' => ['required'],
            'major_id' => ['required'],
            'grade' => ['required', 'integer', 'between:10,12'],
            'max_student' => ['required','integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kelas wajib diisi',
            'major_id' => 'Jurusan wajib diisi',
            'grade.required' => 'Jenjang kelas wajib diisi',
            'grade.between' => 'Jenjang kelas hanya boleh dari kelas 10 hingga kelas 12',
            'max_student.required' => 'Batas maksimal siswa kelas wajib diisi',
            'max_student.integer' => 'Batas maksimal siswa kelas harus angka',
        ];
    }
}
