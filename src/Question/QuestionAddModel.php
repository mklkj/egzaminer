<?php

namespace Egzaminer\Question;

use PDO;
use Egzaminer\Model;

class QuestionAddModel extends Model
{
    public function add($testId, $post)
    {
        if (!isset($post['question']['correct'])) {
            $post['question']['correct'] = 0;
        }
        $qid = $this->addQuestion($testId, $post['question']);
        $cid = $this->addAnswers($testId, $qid, $post['question']['correct'], $post['answers']);
        $c = $this->addCorrectAnswerToQuestion($qid, $cid);

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
        $stmt = $this->db->prepare('INSERT INTO questions (test_id, content)
            VALUES (:test_id, :content)');
        $stmt->bindValue(':test_id', $testId, PDO::PARAM_INT);
        $stmt->bindValue(':content', trim($question['content']), PDO::PARAM_STR);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    /**
     * Add correct answer to question.
     *
     * @param int $id      Question id
     * @param int $correct Correct anwer id
     */
    public function addCorrectAnswerToQuestion($id, $correct)
    {
        $stmt = $this->db->prepare('UPDATE questions SET correct = :correct
            WHERE id = :id');
        $stmt->bindValue(':correct', $correct, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Add answers for test.
     *
     * @param int   $testId
     * @param int   $qid
     * @param int   $correct
     * @param array $answers
     *
     * @return bool
     */
    private function addAnswers($testId, $qid, $correct, $answers)
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

            if ($correct == $key) {
                $correctId = $this->db->lastInsertId();
            }
        }

        if (!isset($correctId)) {
            $correctId = 0;
        }

        $this->db->commit();

        return $correctId;
    }
}
