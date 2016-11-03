<?php

namespace Egzaminer\One;

use Exception;
use Egzaminer\AbstractController;

class Test extends AbstractController
{
    public function showAction($id)
    {
        $testInfo = (new OneTest())->getInfo($id);

        if (false === $testInfo) {
            throw new Exception('Test not exists!');
        }

        $questions = (new Questions())->getByTestId($id);
        $answers = (new Answers())->getAnswersByQuestions($questions);

        // if form was send
        if (!empty($_POST)) {
            $stats = (new TestStat())->getStats($testInfo, $questions, $_POST);

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
