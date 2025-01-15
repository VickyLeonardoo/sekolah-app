<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MajorUpdateRequest extends FormRequest
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

        $majorId = $this->route('major'); // Ambil ID guru dari route

        return [
            'name' => ['required'],
            'code' => ['required',Rule::unique('majors')->ignore($majorId)],
            'description' => ['sometimes'],
        ];
    }
}
