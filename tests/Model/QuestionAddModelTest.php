<?php

use Egzaminer\Model\QuestionAddModel;

class QuestionAddModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new EgzaminerArrayDataSet([
            'questions' => [
                ['id' => 1, 'content' => 'Question content', 'correct' => 128],
            ],
            'answers' => [
                ['id' => 1, 'content' => 'Answer content 1'],
                ['id' => 2, 'content' => 'Answer content 2'],
                ['id' => 3, 'content' => 'Answer content 3'],
                ['id' => 4, 'content' => 'Answer content 4'],
            ],
        ]);
    }

    public function testAdd()
    {
        $dataset = [
            'question' => [
                'content' => 'Question content',
                'correct' => '1',
            ],
            'answers' => [
                1 => 'Answer content 1',
                2 => 'Answer content 2',
                3 => 'Answer content 3',
                4 => 'Answer content 4',
            ],
        ];

        $questionModel = new QuestionAddModel(self::$pdo);
        $questionID = $questionModel->add(128, $dataset);

        $this->assertEquals(2, $questionID);
    }

    public function testAddQuestion()
    {
        $dataset = [
            'question' => [
                'content' => 'Question content',
                'correct' => '2',
            ],
            'answers' => [
                1 => 'Answer content 1',
                2 => 'Answer content 2',
                3 => 'Answer content 3',
                4 => 'Answer content 4',
            ],
        ];

        $questionModel = new QuestionAddModel(self::$pdo);
        $questionID = $questionModel->add(128, $dataset);

        $test = self::$pdo->query('SELECT content, correct FROM questions WHERE id = '.$questionID);
        $dataset['question']['correct'] = '6';

        $this->assertEquals(
            $dataset['question'],
            $test->fetch(PDO::FETCH_ASSOC)
        );
    }

    public function testAddQuestionCorrectOutOfRange()
    {
        $dataset = [
            'question' => [
                'content' => 'Question content',
                'correct' => '5',
            ],
            'answers' => [
                1 => 'Answer content 1',
                2 => 'Answer content 2',
                3 => 'Answer content 3',
                4 => 'Answer content 4',
            ],
        ];

        $questionModel = new QuestionAddModel(self::$pdo);
        $questionID = $questionModel->add(128, $dataset);

        $test = self::$pdo->query('SELECT content, correct FROM questions WHERE id = '.$questionID);
        $dataset['question']['correct'] = '0'; // when dataset['question']['correct'] not match any answers

        $this->assertEquals(
            $dataset['question'],
            $test->fetch(PDO::FETCH_ASSOC)
        );
    }

    public function testAddWhithNoCorrect()
    {
        $dataset = [
            'question' => [
                'content' => 'Question content',
                // 'correct' => 1,
            ],
            'answers' => [
                1 => 'Answer content 1',
                2 => 'Answer content 2',
                3 => 'Answer content 3',
                4 => 'Answer content 4',
            ],
        ];

        $questionModel = new QuestionAddModel(self::$pdo);
        $questionID = $questionModel->add(128, $dataset);

        $this->assertEquals(2, $questionID);
    }
}
