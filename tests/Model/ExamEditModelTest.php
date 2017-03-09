<?php

use Egzaminer\Model\ExamEditModel;

class ExamEditModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new MyApp_DbUnit_ArrayDataSet([
            'exams' => [
                ['title' => 'Test', 'questions' => 10, 'threshold' => 5, 'group_id' => 1, 'id' => 1],
            ],
        ]);
    }

    public function testEdit()
    {
        $dataset = [
            'id' => '1',
            'title' => 'ExamEditModelTest title',
            'questions' => '128',
            'threshold' => '64',
            'group_id' => '5',
        ];

        $model = new ExamEditModel(self::$pdo);
        $id = $model->edit(1, $dataset);

        $test = self::$pdo->query('SELECT * FROM exams WHERE id = 1');

        $this->assertEquals(
            $dataset,
            $test->fetch(PDO::FETCH_ASSOC)
        );
    }
}
