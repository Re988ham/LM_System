<?php

namespace App\Services\Dashboard;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Collection;

class AnswerService
{
    public function list(): Collection
    {
        $answers = Answer::all();
        return $answers;
    }

    public function store(array $data): Answer
    {
        $answer = Answer::create($data);
        return $answer;
    }

    public function update(array $data): Answer
    {
        $answer = $this->findById($data['id']);

        $answer->update($data);

        return $answer->fresh();
    }

    public function findById(int $id): Answer
    {
        $answer = Answer::findOrFail($id);
        return $answer;
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
    }
}
