<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Question\QuestionCreateRequest;
use App\Http\Requests\Dashboard\Question\QuestionUpdateRequest;
use App\Services\Dashboard\QuestionService;
use App\Services\Dashboard\QuizService;
use Exception;

class QuestionController extends Controller
{
    /**
     * @var QuestionService
     */
    private $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionService->list();
        return view('dashboard.pages.quizzes.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($quizId)
    {
        return view('dashboard.pages.quizzes.questions.create', compact('quizId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionCreateRequest $request)
    {
        try {
            $question = $this->questionService->store($request->validated());
            return redirect()->route('admin.quiz.questions', $question->quiz_id)
                ->with('success', 'Question created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.quizzes.questions.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $quizId)
    {
        $question = $this->questionService->findById($quizId);
        return view('dashboard.pages.quizzes.questions.update', compact('question', 'quizId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionUpdateRequest $request)
    {
        try {
            $question = $this->questionService->update($request->validated());
            return redirect()->route('admin.quiz.questions', $question->quiz_id)
                ->with('success', 'Question created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = $this->questionService->findById($id);
        try {
            $this->questionService->destroy($question);
            return redirect()->route('admin.quiz.questions', $question->quiz_id)
                ->with('success', 'Question deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.quiz.questions', $question->quiz_id)->with('error', $e->getMessage());
        }
    }

    /**
     * Display the answers of specific question.
     */
    public function showQuestionAnswers(string $questionId)
    {
        $answers = $this->questionService->showQuestionAnswers($questionId);
        return view('dashboard.pages.quizzes.questions.answers.index', compact(
            'answers',
            'questionId'
        ));
    }
}
