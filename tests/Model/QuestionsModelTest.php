<?php

use Egzaminer\Model\QuestionsModel;

class QuestionsModelTest extends EgzaminerTestsDatabaseTestCase
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
    ];

    public function getDataSet()
    {
        return new EgzaminerArrayDataSet($this->dataset);
    }

    public function testGetByExamId()
    {
        $model = new QuestionsModel(self::$pdo);
        $info = $model->getByExamId(1020);

        $this->assertEquals(
            $this->dataset['questions'],
            $info
        );
    }

    public function testGetByQuestionId()
    {
        $model = new QuestionsModel(self::$pdo);
        $info = $model->getByQuestionId(2);

        $this->assertEquals($this->dataset['questions'][1], $info);
    }
}
