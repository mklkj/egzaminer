<?php

use Tester\TestStat;

class TestStatTest extends \PHPUnit_Framework_TestCase
{
	public function testAnswers()
	{
		$data = $this->getData();

		$stat = new TestStat();
		$results = $stat->getStats($data['testInfo'], $data['questions'], $data['userAnswers']);

		$this->assertEquals($results['answers'], $data['userAnswersCleared']);
	}

	private function getData()
	{
		$testInfo = [
			'id' => 1,
			'title' => 'Unit test',
			'questions' => 8,
			'threshold' => 4,
		];

		$questions = [
			['id' => 1,'correct' => 8],
			['id' => 2,'correct' => 7],
			['id' => 3,'correct' => 6],
			['id' => 4,'correct' => 5],
			['id' => 5,'correct' => 4],
			['id' => 6,'correct' => 3],
			['id' => 7,'correct' => 2],
			['id' => 8,'correct' => 1],
		];

		$userAnswers = [
			'send' => 'yes',
			'question_1' => 8,
			'question_2' => 1,
			'question_3' => 6,
			'question_4' => 2,
			'question_5' => 4,
			'question_6' => 3,
			'question_7' => 8,
			'question_8' => 8,
		];

		$userAnswersCleared = [
			1 => 8,
			2 => 1,
			3 => 6,
			4 => 2,
			5 => 4,
			6 => 3,
			7 => 8,
			8 => 8,
		];

		$compared = [
			1 => [
				'user' => 8,
				'correct' => 8,
			],
			2 => [
				'user' => 1,
				'correct' => 7,
			]
		];

		return [
			'testInfo' => $testInfo,
			'questions' => $questions,
			'userAnswers' => $userAnswers,
			'userAnswersCleared' => $userAnswersCleared,
			'compared' => $compared,
		];
	}
}
