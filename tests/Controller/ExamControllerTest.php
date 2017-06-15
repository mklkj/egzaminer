<?php

use Egzaminer\Controller\ExamController;

class ExamControllerTest extends EgzaminerTestsControllerTestCase
{
    /**
     * @expectedException Exception
     */
    public function testShowActionWhenExamNoExist()
    {
        $controller = new ExamController($this->container);

        $this->assertInternalType('string', $controller->showAction(1));
    }

    public function testShowAction()
    {
        self::$pdo->exec("INSERT INTO exams (id, title, questions, threshold, group_id)
            VALUES (NULL, 'Test', 16, 7, 1)");
        $controller = new ExamController($this->container);

        $this->assertInternalType('string', $controller->showAction(1));
    }
}
