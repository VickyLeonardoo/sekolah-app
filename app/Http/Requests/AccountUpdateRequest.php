<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
    public function rules()
    {
        $id = $this->route('account')->id; // Mengambil ID dari route model binding.

        return [
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $id],
            'phone' => ['required', 'unique:users,phone,' . $id],
            'identity_no' => ['required', 'unique:users,identity_no,' . $id],
            'position' => ['required'],
        ];
    }
}
