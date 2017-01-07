<?php

use Egzaminer\Error;

class ErrorTest extends PHPUnit_Framework_TestCase
{
    public function testShowAction()
    {
        $obj = new Error(404);
        $this->expectOutputString('Error 404');
        $obj->showAction();
    }
}
