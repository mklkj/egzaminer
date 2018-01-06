<?php

use Egzaminer\Exam\CalculateScore;
use PHPUnit\Framework\TestCase;

class CalculateScoreTest extends TestCase
{
    private $test;

    private $notPassAnswers;

    private $passedAnswers;

    public function setUp()
    {
        $this->test = [
            'title'     => 'Calculate Score Test',
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

        $this->assertEquals(2, $obj->getScore());
    }

    public function testCalculatePercentageScore()
    {
        $obj = new CalculateScore($this->test, $this->notPassAnswers);

        $this->assertEquals(20, $obj->calculatePercentageScore());
    }

    public function testCalculatePercentageScoreWhenNoQuestions()
    {
        $obj = new CalculateScore(['questions' => 0], []);

        $this->assertEquals(0.0, $obj->calculatePercentageScore());
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

        $this->assertEquals([
            'score'       => 2,
            'percentages' => 20,
            'isPass'      => false,
        ], $obj->getScoreInfo());
    }
}
