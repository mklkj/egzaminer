<?php

use Egzaminer\Controller\HomepageController;

class HomepageControllerTest extends EgzaminerTestsControllerTestCase
{
    public function testIndexAction()
    {
        $controller = new HomepageController($this->container);

        $this->assertInternalType('string', $controller->indexAction());
    }
}
