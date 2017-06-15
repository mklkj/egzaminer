<?php

use Egzaminer\Exam\CompareUserAnswersWithQuestions;
use PHPUnit\Framework\TestCase;

class CompareUserAnswersWithQuestionsTest extends TestCase
{
    public function testGetNormalizeUserPost()
    {
        $obj = new CompareUserAnswersWithQuestions([
            'send'       => 'yes',
            'question_1' => 8,
            'question_2' => 1,
            'question_3' => 6,
            'question_4' => 2,
            'question_5' => 4,
            'question_6' => 3,
            'question_7' => 8,
            'question_8' => 8,
            'question_9' => 9,
        ], []);

        $this->assertEquals($obj->getNormalizeUserPost(), [
            1 => 8,
            2 => 1,
            3 => 6,
            4 => 2,
            5 => 4,
            6 => 3,
            7 => 8,
            8 => 8,
            9 => 9,
        ]);
    }

    public function testGetNormalizeUserPostWhenIsEmpty()
    {
        $obj = new CompareUserAnswersWithQuestions(['send' => 'yes'], []);

        $this->assertNull($obj->getNormalizeUserPost());
    }

    public function testGetCompared()
    {
        $obj = new CompareUserAnswersWithQuestions([
            'send'       => 'yes',
            'question_1' => 8,
            'question_2' => 1,
            'question_3' => 6,
            'question_4' => 2,
            'question_5' => 4,
            'question_6' => 3,
            'question_7' => 8,
            'question_8' => 8,
        ], [
            ['id' => 1, 'correct' => 8],
            ['id' => 2, 'correct' => 7],
            ['id' => 3, 'correct' => 6],
            ['id' => 4, 'correct' => 5],
            ['id' => 5, 'correct' => 4],
            ['id' => 6, 'correct' => 3],
            ['id' => 7, 'correct' => 2],
            ['id' => 8, 'correct' => 1],
        ]);

        $this->assertEquals($obj->getCompared(), [
            ['id' => 1, 'correct' => 8, 'userAnswer' => 8],
            ['id' => 2, 'correct' => 7, 'userAnswer' => 1],
            ['id' => 3, 'correct' => 6, 'userAnswer' => 6],
            ['id' => 4, 'correct' => 5, 'userAnswer' => 2],
            ['id' => 5, 'correct' => 4, 'userAnswer' => 4],
            ['id' => 6, 'correct' => 3, 'userAnswer' => 3],
            ['id' => 7, 'correct' => 2, 'userAnswer' => 8],
            ['id' => 8, 'correct' => 1, 'userAnswer' => 8],
        ]);
    }

    public function testGetComparedWhenIsEmpty()
    {
        $obj = new CompareUserAnswersWithQuestions(['send' => 'yes'], [
            ['id' => 1, 'correct' => 4],
            ['id' => 2, 'correct' => 3],
            ['id' => 3, 'correct' => 2],
            ['id' => 4, 'correct' => 1],
            ['id' => 5, 'correct' => 4],
            ['id' => 6, 'correct' => 3],
            ['id' => 7, 'correct' => 2],
            ['id' => 8, 'correct' => 1],
        ]);

        $this->assertEquals($obj->getCompared(), [
            ['id' => 1, 'correct' => 4, 'userAnswer' => null],
            ['id' => 2, 'correct' => 3, 'userAnswer' => null],
            ['id' => 3, 'correct' => 2, 'userAnswer' => null],
            ['id' => 4, 'correct' => 1, 'userAnswer' => null],
            ['id' => 5, 'correct' => 4, 'userAnswer' => null],
            ['id' => 6, 'correct' => 3, 'userAnswer' => null],
            ['id' => 7, 'correct' => 2, 'userAnswer' => null],
            ['id' => 8, 'correct' => 1, 'userAnswer' => null],
        ]);
    }
}
