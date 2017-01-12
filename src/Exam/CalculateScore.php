<?php

namespace Egzaminer\Exam;

class CalculateScore
{
    private $exam;

    private $comparedAnswers;

    private $score = 0;

    public function __construct(array $exam, array $comparedAnswers)
    {
        $this->exam = $exam;
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
        if ($this->exam['questions'] > 0) {
            return round($this->score / $this->exam['questions'] * 100, 2);
        }
    }

    public function isPass()
    {
        if ($this->getScore() >= $this->exam['threshold']) {
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
