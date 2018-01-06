<?php

use Egzaminer\Model\QuestionDeleteModel;
use Egzaminer\Tests\Model\EgzaminerArrayDataSet;
use Egzaminer\Tests\Model\EgzaminerTestsDatabaseTestCase;

class QuestionDeleteModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new EgzaminerArrayDataSet([
            'questions' => [
                ['id' => 1, 'content' => 'Question content', 'correct' => 128],
            ],
        ]);
    }

    public function testDelete()
    {
        $model = new QuestionDeleteModel(self::$pdo);
        $status = $model->delete(1);

        $test = self::$pdo->query('SELECT * FROM questions');

        $this->assertEmpty($test->fetchAll(PDO::FETCH_ASSOC));
    }
}
