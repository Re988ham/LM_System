<?php

namespace App\Http\Requests\Dashboard\Quiz;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class QuizUpdateRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255|unique:quizzes,title,' . $this->id,
            //'description' => 'nullable|string|max:1500',
            'question_number' => 'nullable|integer|min:1|max:100',
        ];
    }
}
