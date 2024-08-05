<?php

namespace App\Http\Requests\Dashboard\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
            'specialization_id' => 'sometimes|exists:specializations,id',
            'title' => 'sometimes|string|max:255',
            'url' => 'sometimes|url|max:255',
            'description' => 'sometimes|string|max:255',
            'image' => 'sometimes|mimes:jpg,jpeg,png,pdf|max:2048',
            'xp' => 'sometimes|integer|min:1',
        ];
    }
}
