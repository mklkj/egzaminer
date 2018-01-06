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

    public function __construct(array $exam, array $comparedAnswers)
    {
        $this->exam = $exam;
        $this->comparedAnswers = $comparedAnswers;

        $this->calculate();
    }

    public function calculate()
    {
        foreach ($this->comparedAnswers as $value) {
            if ($value['correct'] === $value['userAnswer']) {
                $this->score++;
            }
        }
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function calculatePercentageScore(): float
    {
        if ($this->exam['questions'] <= 0) {
            return 0.0;
        }

        return round($this->score / $this->exam['questions'] * 100, 2);
    }

    public function isPass(): bool
    {
        return $this->getScore() >= $this->exam['threshold'];
    }

    public function getScoreInfo(): array
    {
        return [
            'score'       => $this->getScore(),
            'percentages' => $this->calculatePercentageScore(),
            'isPass'      => $this->isPass(),
        ];
    }
}
