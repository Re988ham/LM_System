<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Answer\AnswerCreateRequest;
use App\Http\Requests\Dashboard\Answer\AnswerUpdateRequest;
use App\Services\Dashboard\AnswerService;
use Exception;

class AnswerController extends Controller
{
    /**
     * @var AnswerService
     */
    private $answerService;

    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = $this->answerService->list();
        return view('dashboard.pages.quizzes.questions.answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($questionId)
    {
        return view('dashboard.pages.quizzes.questions.answers.create', compact('questionId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerCreateRequest $request)
    {
        try {
            $answer = $this->answerService->store($request->validated());
            return redirect()->route('admin.question.answers', $answer->question_id)
                ->with('success', 'Answer created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.quizzes.questions.answers.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $answerId)
    {
        $answer = $this->answerService->findById($answerId);
        return view('dashboard.pages.quizzes.questions.answers.update', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnswerUpdateRequest $request)
    {
        try {
            $answer = $this->answerService->update($request->validated());
            return redirect()->route('admin.question.answers', $answer->question_id)
                ->with('success', 'Answer created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $answer = $this->answerService->findById($id);
        try {
            $this->answerService->destroy($answer);
            return redirect()->route('admin.question.answers', $answer->question_id)
                ->with('success', 'Answer deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.question.answers', $answer->question_id)
                ->with('error', $e->getMessage());
        }
    }
}
