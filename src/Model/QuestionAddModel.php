<?php

namespace Egzaminer\Model;

use PDO;

class QuestionAddModel extends AbstractModel
{
    public function add(int $examID, array $post): int
    {
        if (!isset($post['question']['correct'])) {
            $post['question']['correct'] = 0;
        }
        $qid = $this->addQuestion($examID, $post['question']);
        $cid = $this->addAnswers($examID, $qid, $post['question']['correct'], $post['answers']);
        $this->addCorrectAnswerToQuestion($qid, $cid);

        return $qid;
    }

    private function addQuestion(int $examID, array $question): int
    {
        $stmt = $this->db->prepare('INSERT INTO questions (exam_id, content)
            VALUES (:exam_id, :content)');
        $stmt->bindValue(':exam_id', $examID, PDO::PARAM_INT);
        $stmt->bindValue(':content', trim($question['content']));
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    private function addCorrectAnswerToQuestion(int $questionID, int $correct): bool
    {
        $stmt = $this->db->prepare('UPDATE questions SET correct = :correct
            WHERE id = :id');
        $stmt->bindValue(':correct', $correct, PDO::PARAM_INT);
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);

        return $stmt->execute();
    }

    private function addAnswers(int $examID, int $questionID, int $correct, array $answers): int
    {
        $stmt = $this->db->prepare('INSERT INTO answers (exam_id, question_id, content)
            VALUES (:exam_id, :question_id, :content)
        ');
        $this->db->beginTransaction();

        foreach ($answers as $key => $value) {
            $stmt->bindValue(':exam_id', $examID, PDO::PARAM_INT);
            $stmt->bindValue(':question_id', $questionID, PDO::PARAM_INT);
            $stmt->bindValue(':content', trim($value));
            $stmt->execute();

            if ($correct === $key) {
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
