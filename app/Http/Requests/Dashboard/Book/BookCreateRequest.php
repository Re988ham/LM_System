<?php

namespace App\Http\Requests\Dashboard\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|string|max:255',
        ];
    }
}
