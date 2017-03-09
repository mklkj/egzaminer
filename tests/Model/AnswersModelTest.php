<?php

use Egzaminer\Model\AnswersModel;

class AnswersModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new MyApp_DbUnit_ArrayDataSet([
            'answers' => [
                ['id' => 1, 'exam_id' => 1, 'question_id' => 1, 'content' => 'Test1'],
                ['id' => 2, 'exam_id' => 1, 'question_id' => 1, 'content' => 'Test2'],
            ],
        ]);
    }

    public function testGetAnswersByOneQuestionId()
    {
        $model = new AnswersModel(self::$pdo);

        $test = self::$pdo->query('SELECT * FROM answers WHERE question_id = 1');

        $this->assertEquals(
            $test->fetchAll(PDO::FETCH_ASSOC),
            $model->getAnswersByOneQuestionId(1)
        );
    }
}
