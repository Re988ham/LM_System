<?php

namespace App\Services\Dashboard;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

class QuestionService
{
    public function list(): Collection
    {
        $questions = Question::all();
        return $questions;
    }

    public function store(array $data): Question
    {
        $question = Question::create($data);
        return $question;
    }

    public function update(array $data): Question
    {
        $question = $this->findById($data['id']);

        $question->update($data);

        return $question->fresh();
    }

    public function findById(int $id): Question
    {
        $question = Question::findOrFail($id);
        return $question;
    }

    public function destroy(Question $question)
    {
        $question->delete();
    }

    public function showQuestionAnswers(int $id)
    {
        $question = $this->findById($id);
        return $question->answers;
    }
}
