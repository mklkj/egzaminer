<?php

use Egzaminer\Model\ExamsGroupModel;

class ExamsGroupModelTest extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new MyApp_DbUnit_ArrayDataSet([
            'exams_groups' => [
                ['id' => 1, 'title' => 'Title1', 'description' => 'fdsa'],
                ['id' => 2, 'title' => 'Title2', 'description' => 'asdf'],
            ],
        ]);
    }

    public function testGetExamsGroups()
    {
        $model = new ExamsGroupModel(self::$pdo);

        $test = self::$pdo->query('SELECT * FROM exams_groups');

        $this->assertEquals(
            $test->fetchAll(PDO::FETCH_ASSOC),
            $model->getExamsGroups()
        );
    }

    public function testGetExamsGroupInfoById()
    {
        $model = new ExamsGroupModel(self::$pdo);

        $test = self::$pdo->query('SELECT * FROM exams_groups WHERE id = 2');

        $this->assertEquals(
            $test->fetch(PDO::FETCH_OBJ),
            $model->getExamsGroupInfoById(2)
        );
    }
}
