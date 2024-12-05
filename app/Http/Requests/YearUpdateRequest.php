<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YearUpdateRequest extends FormRequest
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
            'start_year' => ['required','numeric'],
            'end_year' => ['required','numeric'],
            'start_month' => ['required','numeric','min:1','max:12'],
            'end_month' => ['required','numeric','min:1','max:12'],
            'price' => ['required','numeric'],
            'is_active' => ['sometimes']
        ];
    }
}
