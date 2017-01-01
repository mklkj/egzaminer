<?php

namespace Egzaminer\Exam;

class CompareUserAnswersWithQuestions
{
    public function __construct($post, $questions)
    {
        $this->post = $this->normalizeUserPost($post);
        $this->questions = $questions;
    }

    public function normalizeUserPost($post)
    {
        unset($post['send']);
        if (empty($post)) {
            return;
        }

        foreach ($post as $key => $value) {
            $post[str_replace('question_', '', $key)] = $value;
        }

        return $post;
    }

    public function getCompared()
    {
        foreach ($this->questions as $key => $value) {
            if (isset($this->post[$value['id']])) {
                $userAnswer = $this->post[$value['id']];
            } else {
                $userAnswer = null;
            }

            $this->questions[$key]['userAnswer'] = $userAnswer;
        }

        return $this->questions;
    }
}
