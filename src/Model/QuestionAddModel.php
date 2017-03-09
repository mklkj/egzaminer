<?php

namespace Egzaminer\Model;

use PDO;

class QuestionAddModel extends AbstractModel
{
    public function add($examID, $post)
    {
        if (!isset($post['question']['correct'])) {
            $post['question']['correct'] = 0;
        }
        $qid = $this->addQuestion($examID, $post['question']);
        $cid = $this->addAnswers($examID, $qid, $post['question']['correct'], $post['answers']);
        $this->addCorrectAnswerToQuestion($qid, $cid);

        return $qid;
    }

    /**
     * Add question for exam.
     *
     * @param int   $examID
     * @param array $question
     *
     * @return book
     */
    private function addQuestion($examID, $question)
    {
        $stmt = $this->db->prepare('INSERT INTO questions (exam_id, content)
            VALUES (:exam_id, :content)');
        $stmt->bindValue(':exam_id', $examID, PDO::PARAM_INT);
        $stmt->bindValue(':content', trim($question['content']), PDO::PARAM_STR);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    /**
     * Add correct answer to question.
     *
     * @param int $questionID Question id
     * @param int $correct    Correct anwer id
     */
    private function addCorrectAnswerToQuestion($questionID, $correct)
    {
        $stmt = $this->db->prepare('UPDATE questions SET correct = :correct
            WHERE id = :id');
        $stmt->bindValue(':correct', $correct, PDO::PARAM_INT);
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Add answers for exam.
     *
     * @param int   $examID
     * @param int   $questionID
     * @param int   $correct
     * @param array $answers
     *
     * @return bool
     */
    private function addAnswers($examID, $questionID, $correct, $answers)
    {
        $stmt = $this->db->prepare('INSERT INTO answers (exam_id, question_id, content)
            VALUES (:exam_id, :question_id, :content)
        ');
        $this->db->beginTransaction();

        foreach ($answers as $key => $value) {
            $stmt->bindValue(':exam_id', $examID, PDO::PARAM_INT);
            $stmt->bindValue(':question_id', $questionID, PDO::PARAM_INT);
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
