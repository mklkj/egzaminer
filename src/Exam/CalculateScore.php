<?php

namespace Egzaminer\Exam;

class CalculateScore
{
    /**
     * @var array
     */
    private $exam;

    /**
     * @var array
     */
    private $comparedAnswers;

    /**
     * @var int
     */
    private $score = 0;

    /**
     * Constructor.
     *
     * @param array $exam
     * @param array $comparedAnswers
     */
    public function __construct(array $exam, array $comparedAnswers)
    {
        $this->exam = $exam;
        $this->comparedAnswers = $comparedAnswers;

        $this->calculate();
    }

    /**
     * Calculate score.
     *
     * @return void
     */
    public function calculate()
    {
        foreach ($this->comparedAnswers as $key => $value) {
            if ($value['correct'] === $value['userAnswer']) {
                $this->score++;
            }
        }
    }

    /**
     * Get score.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Calculate percentage score.
     *
     * @return float|null
     */
    public function calculatePercentageScore()
    {
        if ($this->exam['questions'] > 0) {
            return round($this->score / $this->exam['questions'] * 100, 2);
        }
    }

    /**
     * Check is exam passed.
     *
     * @return bool
     */
    public function isPass()
    {
        if ($this->getScore() >= $this->exam['threshold']) {
            return true;
        }

        return false;
    }

    /**
     * Get all score info.
     *
     * @return array
     */
    public function getScoreInfo()
    {
        return [
            'score'       => $this->getScore(),
            'percentages' => $this->calculatePercentageScore(),
            'isPass'      => $this->isPass(),
        ];
    }
}
