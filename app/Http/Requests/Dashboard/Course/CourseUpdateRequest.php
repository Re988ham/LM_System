<?php

namespace App\Http\Requests\Dashboard\Course;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'specialization_id' => 'required',
            'image' => 'sometimes|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
