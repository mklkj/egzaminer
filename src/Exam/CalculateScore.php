<?php

namespace Egzaminer\Exam;

class CalculateScore
{
    private $score = 0;

    public function __construct(array $test, array $comparedAnswers)
    {
        $this->test = $test;
        $this->comparedAnswers = $comparedAnswers;

        $this->calculate();
    }

    public function calculate()
    {
        foreach ($this->comparedAnswers as $key => $value) {
            if ($value['correct'] === $value['userAnswer']) {
                $this->score++;
            }
        }
    }

    public function getScore()
    {
        return $this->score;
    }

    public function calculatePercentageScore()
    {
        return round($this->score / $this->test['questions'] * 100, 2);
    }

    public function isPass()
    {
        if ($this->getScore() >= $this->test['threshold']) {
            return true;
        }

        return false;
    }

    public function getScoreInfo()
    {
        return [
          'score'       => $this->getScore(),
          'percentages' => $this->calculatePercentageScore(),
          'isPass'      => $this->isPass(),
        ];
    }
}
