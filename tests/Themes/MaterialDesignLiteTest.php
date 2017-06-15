<?php

use Egzaminer\Themes\MaterialDesignLite;
use PHPUnit\Framework\TestCase;

class MaterialDesignLiteTest extends TestCase
{
    public function testWrapMessages()
    {
        $test = new MaterialDesignLite();

        $this->assertInternalType('string', $test->wrapMessages('asdf', 'success'));
    }
}
