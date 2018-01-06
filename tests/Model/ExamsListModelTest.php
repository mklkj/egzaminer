<?php

use Egzaminer\Model\ExamsListModel;
use Egzaminer\Tests\Model\EgzaminerArrayDataSet;
use Egzaminer\Tests\Model\EgzaminerTestsDatabaseTestCase;

class ExamsListModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new EgzaminerArrayDataSet([
            'exams' => [
                ['id' => 1, 'title' => 'Title1', 'questions' => '142', 'group_id' => '4'],
                ['id' => 2, 'title' => 'Title2', 'questions' => '127', 'group_id' => '5'],
            ],
        ]);
    }

    public function testGetList()
    {
        $model = new ExamsListModel(self::$pdo);

        $test = self::$pdo->query('SELECT id, title, questions FROM exams');

        $this->assertEquals(
            $test->fetchAll(PDO::FETCH_ASSOC),
            $model->getList()
        );
    }

    public function testGetExamsByGroupId()
    {
        $model = new ExamsListModel(self::$pdo);

        $test = self::$pdo->query('SELECT id, title, questions FROM exams WHERE group_id = 5');

        $this->assertEquals(
            $test->fetchAll(PDO::FETCH_ASSOC),
            $model->getExamsByGroupId(5)
        );
    }
}
