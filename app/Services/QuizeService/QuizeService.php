<?php

namespace App\Services\QuizeService;



use App\Models\Answer;
use App\Models\Live;
use App\Models\Question;
use App\Models\Quize;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuizeService
{
    /**
     Service for manage Quizes operations in the system.
    */

    public function createQuize($data)
    {
        $data['user_id'] = Auth::user()->id;
        $quiz = Quize::create($data);
        $questions = [];
        $answers = [];

        if ($quiz) {
            $quizID = $quiz->id;
            foreach ($data['questions'] as $ques) {
                $ques['quize_id'] = $quizID;
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


    public function getQuizes()
    {
        return Quize::all();
    }

    public function getQuestions($id)
    {
        return Question::where('quize_id',$id)->get();
    }
//    public function createQuestions($data, $quiz)
//    {
//        $questions = [];
//        if ($quiz) {
//            $quizId = $quiz->id;
//            foreach ($data['questions'] as $ques) {
//                $ques['quize_id'] = $quizId;
//                $questions[] = Question::create($ques);
//            }
//        }
//        return $questions;
//    }
}
