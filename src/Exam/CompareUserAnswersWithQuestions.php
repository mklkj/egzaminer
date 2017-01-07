<?php

namespace Egzaminer\Exam;

class CompareUserAnswersWithQuestions
{
    private $post;

    private $questions;

    public function __construct($post, $questions)
    {
        $this->post = $post;
        $this->questions = $questions;
    }

    public function getNormalizeUserPost()
    {
        unset($this->post['send']);
        if (empty($this->post)) {
            return;
        }

        $post = [];

        foreach ($this->post as $key => $value) {
            $post[str_replace('question_', '', $key)] = $value;
        }

        return $post;
    }

    public function getCompared()
    {
        $post = $this->getNormalizeUserPost();

        foreach ($this->questions as $key => $value) {
            if (isset($post[$value['id']])) {
                $userAnswer = $post[$value['id']];
            } else {
                $userAnswer = null;
            }

            $this->questions[$key]['userAnswer'] = $userAnswer;
        }

        return $this->questions;
    }
}
