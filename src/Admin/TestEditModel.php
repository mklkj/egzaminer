<?php

namespace Tester\Admin;

use PDO;
use Tester\AbstractModel;

class TestEditModel extends AbstractModel
{
    public function edit($id, $post)
    {
       return $this->editTest($id, $post['test'])
        && $this->editQuestions($post['questions'])
        && $this->editAnswers($post['answers']);
    }

    /**
     * Edit test.
     *
     * @param int $id
     * @param array $test
     *
     * @return bool
     */
    private function editTest($id, $test)
    {
        $stmt = $this->db->prepare('UPDATE tests SET title = :title,
            questions = :questions, threshold = :threshold WHERE id = :id'
        );
        $stmt->bindValue(':title', trim($test['title']), PDO::PARAM_STR);
        $stmt->bindValue(':questions', $test['questions'], PDO::PARAM_INT);
        $stmt->bindValue(':threshold', $test['threshold'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Edit questions in test.
     *
     * @param array $questions
     *
     * @return book
     */
    private function editQuestions($questions)
    {
        $stmt = $this->db->prepare('UPDATE questions SET content = :content,
            correct = :correct WHERE id = :id');
        $this->db->beginTransaction();

        foreach ($questions as $key => $value) {
            $stmt->bindValue(':content', trim($value['content']), PDO::PARAM_STR);
            $stmt->bindValue(':correct', $value['correct'], PDO::PARAM_INT);
            $stmt->bindValue(':id', $key, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $this->db->commit();
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
