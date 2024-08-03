<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'mobile_number' => 'required|numeric|unique:users',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'gender' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'google_id' => 'nullable|string',
            'country_id' => 'required|integer',
            'role_id' => 'required|integer',
        ];
    }
}
