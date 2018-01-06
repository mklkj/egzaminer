<?php

namespace Egzaminer\Exam;

class CompareUserAnswersWithQuestions
{
    /**
     * @var array
     */
    private $post;

    /**
     * @var array
     */
    private $questions;

    public function __construct(array $post, array $questions)
    {
        $this->post = $post;
        $this->questions = $questions;
    }

    public function getNormalizeUserPost(): array
    {
        unset($this->post['send']);
        if (empty($this->post)) {
            return [];
        }

        $post = [];

        foreach ($this->post as $key => $value) {
            $post[str_replace('question_', '', $key)] = $value;
        }

        return $post;
    }

    public function getCompared(): array
    {
        $post = $this->getNormalizeUserPost();

        foreach ($this->questions as $key => $value) {
            $userAnswer = null;

            if (isset($post[$value['id']])) {
                $userAnswer = $post[$value['id']];
            }

            $this->questions[$key]['userAnswer'] = $userAnswer;
        }

        return $this->questions;
    }
}
