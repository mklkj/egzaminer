<?php

use Egzaminer\Exam\CalculateScore;

class CalculateScoreTest extends PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        $this->test = [
            'title' => 'Calculate Score Test',
            'questions' => 10,
            'threshold' => 8,
        ];

        $this->notPassAnswers = [
            ['id' => 1, 'correct' => 1, 'userAnswer' => 5],
            ['id' => 2, 'correct' => 2, 'userAnswer' => 4],
            ['id' => 3, 'correct' => 3, 'userAnswer' => 3],
            ['id' => 4, 'correct' => 4, 'userAnswer' => 2],
            ['id' => 5, 'correct' => 5, 'userAnswer' => 1],
            ['id' => 6, 'correct' => 5, 'userAnswer' => 1],
            ['id' => 7, 'correct' => 4, 'userAnswer' => 2],
            ['id' => 8, 'correct' => 3, 'userAnswer' => 3],
            ['id' => 8, 'correct' => 2, 'userAnswer' => 4],
            ['id' => 8, 'correct' => 1, 'userAnswer' => 5],
        ];

        $this->passedAnswers = [
            ['id' => 1, 'correct' => 1, 'userAnswer' => 1],
            ['id' => 2, 'correct' => 2, 'userAnswer' => 2],
            ['id' => 3, 'correct' => 3, 'userAnswer' => 3],
            ['id' => 4, 'correct' => 4, 'userAnswer' => 4],
            ['id' => 5, 'correct' => 5, 'userAnswer' => 5],
            ['id' => 6, 'correct' => 5, 'userAnswer' => 5],
            ['id' => 7, 'correct' => 4, 'userAnswer' => 4],
            ['id' => 8, 'correct' => 3, 'userAnswer' => 3],
            ['id' => 8, 'correct' => 2, 'userAnswer' => 2],
            ['id' => 8, 'correct' => 1, 'userAnswer' => 1],
        ];
    }

    public function testNormalizeUserPost()
    {
        $obj = new CalculateScore($this->test, $this->notPassAnswers);

        $this->assertEquals($obj->getScore(), 2);
    }

    public function testCalculatePercentageScore()
    {
        $obj = new CalculateScore($this->test, $this->notPassAnswers);

        $this->assertEquals($obj->calculatePercentageScore(), 20);
    }

    public function testIsPass()
    {
        $obj = new CalculateScore($this->test, $this->notPassAnswers);

        $this->assertFalse($obj->isPass());
    }

    public function testIsPassWhenReallyPass()
    {
        $obj = new CalculateScore($this->test, $this->passedAnswers);

        $this->assertTrue($obj->isPass());
    }

    public function testGetScoreInfo()
    {
        $obj = new CalculateScore($this->test, $this->notPassAnswers);

        $this->assertEquals($obj->getScoreInfo(), [
            'score' => 2,
            'percentages' => 20,
            'isPass' => false,
        ]);
    }
}
