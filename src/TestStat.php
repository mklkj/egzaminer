<?php

namespace Tester;

class TestStat
{
    public function getStats($testInfo, $correct, $post)
    {
        $this->testInfo = $testInfo;
        $this->correct = $correct;
        $this->post = $post;

        $answers = $this->answers($post);
        $results = $this->calculate($testInfo, $answers);

        return [
            'answers' => $answers,
            'results' => $results,
        ];
    }

    private function answers($post)
    {
        unset($post['send']);
        if (empty($post)) {
            return;
        }

        foreach ($post as $key => $value) {
            $answers[str_replace('question_', '', $key)] = $value;
        }

        return $answers;
    }

    /**
     * Compare correct answers and user answers.
     *
     * @param array $question
     * @param array $answers
     *
     * @return array
     */
    private function compare($question, $answers)
    {
        foreach ($question as $key => $value) {
            $compareAnswers[$value['id']] = [
                'user' => isset($answers[$value['id']]) ? $answers[$value['id']] : null,
                'correct' => $value['correct'],
           ];
        }

        return $compareAnswers;
    }

    private function calculate($testInfo, $answers)
    {
        $compared = $this->compare($this->correct, $answers);

        $correct = 0;
        foreach ($compared as $key => $value) {
            $correct = ($value['user'] === $value['correct']) ? $correct + 1 : $correct;
        }

        return [
            'percentages' => round(($correct / $testInfo['questions']) * 100, 1),
            'threshold' => round(($testInfo['threshold'] / $testInfo['questions']) * 100, 1),
            'pass' => $correct >= $testInfo['threshold'],
        ];
    }
}
