<?php

namespace Egzaminer\Controller;

use Egzaminer\Exam\CalculateScore;
use Egzaminer\Exam\CompareUserAnswersWithQuestions;
use Egzaminer\Model\AnswersModel;
use Egzaminer\Model\ExamModel;
use Egzaminer\Model\QuestionsModel;
use Exception;

class ExamController extends AbstractController
{
    /**
     * Exam page with questions.
     *
     * GET /exam/[i:id]
     *
     * @param int $examID Exam ID
     *
     * @return string
     */
    public function showAction($examID)
    {
        $examInfo = (new ExamModel($this->get('dbh')))->getInfo($examID);

        if (false === $examInfo) {
            throw new Exception('Exam not exists!');
        }

        $questions = (new QuestionsModel($this->get('dbh')))->getByExamId($examID);
        $answers = (new AnswersModel($this->get('dbh')))->getAnswersByQuestions($questions);

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

        return $this->render('front/exam', [
            'title'     => $examInfo['title'],
            'exam'      => $examInfo,
            'questions' => $questions,
            'score'     => $scoreInfo,
        ]);
    }
}
