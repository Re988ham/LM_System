<?php

namespace App\Services\QuizService;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Specialization;
use App\Models\User;
use App\Traits\SendCertificateEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizService
{
    use SendCertificateEmail;

    public function createQuiz($data)
    {
        $data['user_id'] = Auth::user()->id;
        $quiz = Quiz::create($data);
        $questions = [];
        $answers = [];

        if ($quiz) {
            $quizID = $quiz->id;
            foreach ($data['questions'] as $ques) {
                $ques['quiz_id'] = $quizID;
                $question = Question::create($ques);

                if ($question) {
                    $questionID = $question->id;
                    $questions[] = $question;

                    foreach ($ques['answers'] as $answer) {
                        $answer['question_id'] = $questionID;
                        $answerObj = Answer::create($answer);
                        if ($answerObj) {
                            $answers[] = $answerObj;
                        }
                    }
                }
            }
        }

        return ['quiz' => $quiz, 'questions' => $questions, 'answers' => $answers];
    }

    public function getQuizzes()
    {
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            $course = Course::find($quiz->course_id);
            $user = User::find($quiz->user_id);
            $specialization = $course ? Specialization::find($course->specialization_id) : null;

            $quiz['course_name'] = $course ? $course->name : 'Unknown Course';
            $quiz['user_name'] = $user ? $user->name : 'Unknown User';
            $quiz['specialization_name'] = $specialization ? $specialization->name : 'Unknown Specialization';
        }

        return $quizzes;
    }

    public function getQuestions($quizId)
    {
        $questions = Question::where('quiz_id', $quizId)
            ->with('answers')
            ->get();

        return response()->json(['questions' => $questions]);
    }

    public function make_certification(Request $request): \Illuminate\Http\JsonResponse|array
    {
        $final_mark = $request->input('final_mark');
        $quiz_id = $request->input('quiz_id');

        $quiz = Quiz::find($quiz_id);
        if (!$quiz) {
            return response()->json(["error" => "Quiz not found"], 404);
        }

        $course_of_quiz = Course::find($quiz->course_id);
        if (!$course_of_quiz) {
            return response()->json(["error" => "Course not found"], 404);
        }

        $specialization_of_quiz = Specialization::find($course_of_quiz->specialization_id);
        if (!$specialization_of_quiz) {
            return response()->json(["error" => "Specialization not found"], 404);
        }

        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json(["error" => "User not found"], 404);
        }

        $recipient = $user->email;
        $response = [
            'user' => $user->name,
            'course' => $course_of_quiz->name,
            'specialization' => $specialization_of_quiz->name,
            'by creator' => User::find($course_of_quiz->user_id)->name,
            'final mark' => $final_mark
        ];

        // Send the certificate email
        $this->sendCertificate($response, $recipient);

        return $response;
    }
}
