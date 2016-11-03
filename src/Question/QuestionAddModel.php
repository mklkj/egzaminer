<?php

namespace Egzaminer\Question;

use PDO;
use Egzaminer\Model;

class QuestionAddModel extends Model
{
    public function add($testId, $post)
    {
        $qid = $this->addQuestion($testId, $post['question']);
        $this->addAnswers($testId, $qid, $post['answers']);

        return $qid;
    }

    /**
     * Add question for test.
     *
     * @param int   $testId
     * @param array $question
     *
     * @return book
     */
    private function addQuestion($testId, $question)
    {
        $stmt = $this->db->prepare('INSERT INTO questions (test_id, content, correct)
            VALUES (:test_id, :content, :correct)');
        $stmt->bindValue(':test_id', $testId, PDO::PARAM_INT);
        $stmt->bindValue(':content', trim($question['content']), PDO::PARAM_STR);
        $stmt->bindValue(':correct', $question['correct'], PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    /**
     * Add answers for test.
     *
     * @param int   $testId
     * @param int   $qid
     * @param array $answers
     *
     * @return bool
     */
    private function addAnswers($testId, $qid, $answers)
    {
        $stmt = $this->db->prepare('INSERT INTO answers (test_id, question_id, content)
            VALUES (:test_id, :question_id, :content)
        ');
        $this->db->beginTransaction();

        foreach ($answers as $key => $value) {
            $stmt->bindValue(':test_id', $testId, PDO::PARAM_INT);
            $stmt->bindValue(':question_id', $qid, PDO::PARAM_INT);
            $stmt->bindValue(':content', trim($value), PDO::PARAM_STR);
            $stmt->execute();
        }

        return $this->db->commit();
    }
}
