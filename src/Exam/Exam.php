<?php

namespace Egzaminer\Exam;

use Exception;
use Egzaminer\Question\Questions;
use Egzaminer\Question\Answers;
use Egzaminer\Admin\Dashboard as Controller;

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
            $stats = (new ExamStat())->getStats($testInfo, $questions, $_POST);

            $this->data['test-check'] = [
                'test' => $testInfo,
                'questions' => $questions,
                'answers' => $answers,
                'stats' => $stats,
            ];

            $template = 'test-check';
        } else {
            $this->data['test'] = [
                'title' => $testInfo['title'],
                'questions' => $questions,
                'answers' => $answers,
            ];

            $template = 'test';
        }

        $this->render($template);
    }
}
