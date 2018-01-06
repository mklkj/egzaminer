<?php

use Egzaminer\Controller\HomepageController;
use Egzaminer\Tests\Controller\EgzaminerTestsControllerTestCase;

class HomepageControllerTest extends EgzaminerTestsControllerTestCase
{
    public function testIndexAction()
    {
        $controller = new HomepageController($this->container);

        $this->assertInternalType('string', $controller->indexAction());
    }
}
