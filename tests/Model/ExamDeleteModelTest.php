<?php

use Egzaminer\Model\ExamDeleteModel;
use Egzaminer\Tests\Model\EgzaminerArrayDataSet;
use Egzaminer\Tests\Model\EgzaminerTestsDatabaseTestCase;

class ExamDeleteModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new EgzaminerArrayDataSet([
            'exams' => [
                ['title' => 'Test', 'questions' => 10, 'threshold' => 5, 'group_id' => 1, 'id' => 1],
            ],
        ]);
    }

    public function testDelete()
    {
        $model = new ExamDeleteModel(self::$pdo);
        $status = $model->delete(1);

        $test = self::$pdo->query('SELECT * FROM exams');

        $this->assertEmpty($test->fetch(PDO::FETCH_ASSOC));
    }
}
