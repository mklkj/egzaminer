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

    /**
     * Constructor.
     *
     * @param array $post
     * @param array $questions
     */
    public function __construct(array $post, $questions)
    {
        $this->post = $post;
        $this->questions = $questions;
    }

    /**
     * Get normalized user post.
     *
     * @return array
     */
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

    /**
     * Get compared data.
     *
     * @return array
     */
    public function getCompared()
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
