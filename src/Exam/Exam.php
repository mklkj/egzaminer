<?php

namespace Egzaminer\Exam;

use Egzaminer\Controller as Controller;
use Egzaminer\Question\Answers;
use Egzaminer\Question\Questions;
use Exception;

class Exam extends Controller
{
    public function showAction($examID)
    {
        $examInfo = (new ExamModel($this->get('dbh')))->getInfo($examID);

        if (false === $examInfo) {
            throw new Exception('Exam not exists!');
        }

        $questions = (new Questions($this->get('dbh')))->getByExamId($examID);
        $answers = (new Answers($this->get('dbh')))->getAnswersByQuestions($questions);

        // if form was send
        if (!empty($this->getFromRequest('post'))) {
            $compareAnswers = new CompareUserAnswersWithQuestions(
                $this->getFromRequest('post'),
                $questions
            );
            $questions = $compareAnswers->getCompared();

            $score = new CalculateScore($examInfo, $questions);
            $scoreInfo = $score->getScoreInfo();
        } else {
            $scoreInfo = null;
        }

        // put answers to questions
        foreach ($questions as $qkey => $qvalue) {
            foreach ($answers[$qvalue['id']] as $akey => $avalue) {
                $questions[$qkey]['answers'][] = $avalue;
            }
        }

        $this->render('front/exam', [
            'title'     => $examInfo['title'],
            'exam'      => $examInfo,
            'questions' => $questions,
            'score'     => $scoreInfo,
        ]);
    }
}
