<?php

namespace App\Http\Requests\Dashboard\Advertisement;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AdvertisementCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'specialization_id' => 'required|exists:specializations,id',
            'image' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'description' => 'required|string|max:255',
        ];
    }
}
