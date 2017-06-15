<?php

use Egzaminer\Model\QuestionEditModel;

class QuestionEditModelTest extends EgzaminerTestsDatabaseTestCase
{
    private $dataset = [
        'questions' => [
            [
                'id'      => '1',
                'content' => 'Question content',
                'correct' => '128',
                'exam_id' => '1020',
                'image'   => 'random.gif',
            ],
            [
                'id'      => '2',
                'content' => 'Another question content',
                'correct' => '64',
                'exam_id' => '1020',
                'image'   => 'meme.jpeg',
            ],
        ],
        'answers' => [
            [
                'id'          => '1',
                'exam_id'     => '1020',
                'question_id' => '2',
                'content'     => 'Test answers 1',
            ],
            [
                'id'          => '2',
                'exam_id'     => '1020',
                'question_id' => '2',
                'content'     => 'Test answers 2',
            ],
            [
                'id'          => '3',
                'exam_id'     => '1020',
                'question_id' => '2',
                'content'     => 'Test answers 3',
            ],
            [
                'id'          => '4',
                'exam_id'     => '1020',
                'question_id' => '2',
                'content'     => 'Test answers 4',
            ],
        ],
    ];

    public function getDataSet()
    {
        return new EgzaminerArrayDataSet($this->dataset);
    }

    public function testEdit()
    {
        $questionID = '1';

        $fileArray = [];
        $dataset = [
            'question' => [
                'id'      => $questionID,
                'content' => 'Question content',
                'correct' => '128',
                'exam_id' => '1020',
                'image'   => 'random.gif',
            ],
            'answers' => [],
        ];

        $model = new QuestionEditModel(self::$pdo);
        $id = $model->edit($questionID, $dataset, $fileArray, '/tmp/');

        $test = self::$pdo->query('SELECT * FROM questions WHERE id = '.$questionID);

        $this->assertEquals(
            $dataset['question'],
            $test->fetch(PDO::FETCH_ASSOC)
        );
    }

    public function testEditImageChangedInDB()
    {
        $questionID = '1';

        $fileArray = [
            'name'     => 'changed.jpg',
            'tmp_name' => '/tmp/public/php123.tmp',
        ];
        $dataset = [
            'question' => [
                'id'      => $questionID,
                'content' => 'Question content',
                'correct' => '128',
                'exam_id' => '1020',
                'image'   => 'random.gif',
            ],
            'answers' => [],
        ];

        $model = new QuestionEditModel(self::$pdo);
        $id = $model->edit($questionID, $dataset, $fileArray, '/tmp/');

        $test = self::$pdo->query('SELECT * FROM questions WHERE id = '.$questionID);
        $dataset['question']['image'] = $fileArray['name'];

        $this->assertEquals(
            $dataset['question'],
            $test->fetch(PDO::FETCH_ASSOC)
        );
    }

    public function testEditAnswers()
    {
        $questionID = '2';

        $fileArray = [];
        $dataset = [
            'question' => [
                'id'      => $questionID,
                'content' => 'Question content from edit answers test',
                'correct' => '4',
                'exam_id' => '1020',
                'image'   => 'idylla.gif',
            ],
            'answers' => [
                '1' => 'Tested answer1',
                '2' => 'Tested answer2',
                '3' => 'Tested answer3',
                '4' => 'Tested answer4',
            ],
        ];

        $model = new QuestionEditModel(self::$pdo);
        $id = $model->edit($questionID, $dataset, $fileArray, '/tmp/');

        $test = self::$pdo->query('SELECT * FROM answers WHERE question_id = '.$questionID);

        $this->assertEquals([
                [
                    'id'          => '1',
                    'content'     => 'Tested answer1',
                    'exam_id'     => $dataset['question']['exam_id'],
                    'question_id' => $questionID,
                ],
                [
                    'id'          => '2',
                    'content'     => 'Tested answer2',
                    'exam_id'     => $dataset['question']['exam_id'],
                    'question_id' => $questionID,
                ],
                [
                    'id'          => '3',
                    'content'     => 'Tested answer3',
                    'exam_id'     => $dataset['question']['exam_id'],
                    'question_id' => $questionID,
                ],
                [
                    'id'          => '4',
                    'content'     => 'Tested answer4',
                    'exam_id'     => $dataset['question']['exam_id'],
                    'question_id' => $questionID,
                ],
            ],
            $test->fetchAll(PDO::FETCH_ASSOC)
        );
    }
}
