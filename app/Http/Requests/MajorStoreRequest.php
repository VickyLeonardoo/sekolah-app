<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MajorStoreRequest extends FormRequest
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
            'code' => ['required','unique:majors,code'],
            'description' => ['sometimes'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'code.required' => 'Kode harus diisi',
            'code.unique' => 'Kode sudah digunakan',
        ];
    }
}
