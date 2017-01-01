<?php

namespace Egzaminer\Exam;

use Exception;
use Egzaminer\Question\Questions;
use Egzaminer\Question\Answers;
use Egzaminer\Controller as Controller;

class Exam extends Controller
{
    public function showAction($id)
    {
        $testInfo = (new ExamModel())->getInfo($id);

        if (false === $testInfo) {
            throw new Exception('Exam not exists!');
        }

        $questions = (new Questions())->getByExamId($id);
        $answers = (new Answers())->getAnswersByQuestions($questions);

        // if form was send
        if (!empty($_POST)) {
            $compareAnswers = new CompareUserAnswersWithQuestions($_POST, $questions);
            $questions = $compareAnswers->getCompared();

            $score = new CalculateScore($testInfo, $questions);
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

        $this->render('test', [
            'title' => $testInfo['title'],
            'test' => $testInfo,
            'questions' => $questions,
            'score' => $scoreInfo,
        ]);
    }
}
