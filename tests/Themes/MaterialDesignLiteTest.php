<?php

use Egzaminer\Themes\MaterialDesignLite;

class MaterialDesignLiteTest extends PHPUnit_Framework_TestCase
{
    public function testWrapMessages()
    {
        $test = new MaterialDesignLite();

        $this->assertInternalType('string', $test->wrapMessages('asdf', 'success'));
    }
}
