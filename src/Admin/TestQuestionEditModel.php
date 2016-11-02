<?php

namespace Tester\Admin;

use PDO;
use Tester\AbstractModel;

class TestQuestionEditModel extends AbstractModel
{
    public function edit($id, $post)
    {
        return $this->editQuestion($id, $post['question'])
        && $this->editAnswers($post['answers']);
    }

    /**
     * Edit question in test.
     *
     * @param int $id
     * @param array $question
     *
     * @return book
     */
    private function editQuestion($id, $question)
    {
        $stmt = $this->db->prepare('UPDATE questions SET content = :content,
            correct = :correct WHERE id = :id');
        $stmt->bindValue(':content', trim($question['content']), PDO::PARAM_STR);
        $stmt->bindValue(':correct', $question['correct'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->execute();
    }

    /**
     * Edit answers in test.
     *
     * @param array $answers
     *
     * @return bool
     */
    private function editAnswers($answers)
    {
        $stmt = $this->db->prepare('UPDATE answers SET content = :content
            WHERE id = :id');
        $this->db->beginTransaction();

        foreach ($answers as $key => $value) {
            $stmt->bindValue(':content', trim($value), PDO::PARAM_STR);
            $stmt->bindValue(':id', $key, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $this->db->commit();
    }
}
