<?php

use Egzaminer\Model\AnswersModel;

class AnswersModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new EgzaminerArrayDataSet([
            'answers' => [
                ['id' => 1, 'exam_id' => 1, 'question_id' => 1, 'content' => 'Test1'],
                ['id' => 2, 'exam_id' => 1, 'question_id' => 1, 'content' => 'Test2'],
                ['id' => 3, 'exam_id' => 1, 'question_id' => 2, 'content' => 'Test2'],
                ['id' => 4, 'exam_id' => 1, 'question_id' => 2, 'content' => 'Test2'],
            ],
        ]);
    }

    public function testGetAnswersByQuestionsWhenEmptyInput()
    {
        $model = new AnswersModel(self::$pdo);
        $answers = $model->getAnswersByQuestions([]);

        $this->assertNull($answers);
    }

    public function testGetAnswersByQuestionsWhenNoAnswers()
    {
        self::$pdo->exec('DELETE FROM answers');
        $model = new AnswersModel(self::$pdo);
        $answers = $model->getAnswersByQuestions(['id' => 1, 'id' => 2]);

        $this->assertEmpty($answers);
    }

    public function testGetAnswersByQuestions()
    {
        $model = new AnswersModel(self::$pdo);
        $answers = $model->getAnswersByQuestions([
            ['id' => 1],
            ['id' => 2],
        ]);

        $this->assertEquals(2, count($answers));
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
