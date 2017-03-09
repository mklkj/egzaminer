<?php

use Egzaminer\Model\ExamAddModel;

class ExamAddModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new MyApp_DbUnit_ArrayDataSet([
            'exams' => [
                ['title' => 'Test', 'questions' => 10, 'threshold' => 5, 'group_id' => 1, 'id' => 1],
            ],
        ]);
    }

    public function testAdd()
    {
        $dataset = [
            'title' => 'ExamAddModelTest title',
            'questions' => 128,
            'threshold' => 64,
            'group_id' => 5,
        ];

        $model = new ExamAddModel(self::$pdo);
        $id = $model->add($dataset);

        $test = self::$pdo->query('SELECT * FROM exams WHERE id = '.$id);

        $dataset['id'] = $id;

        $this->assertEquals(
            $dataset,
            $test->fetch(PDO::FETCH_ASSOC)
        );
    }
}
