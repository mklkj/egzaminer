<?php

namespace Egzaminer\Question;

use Egzaminer\App;
use Egzaminer\Model;
use PDO;

class QuestionEditModel extends Model
{
    public function edit($questionID, $post)
    {
        return $this->editQuestion($questionID, $post['question'])
        && $this->editAnswers($post['answers']);
    }

    /**
     * Edit question in exam.
     *
     * @param int   $questionID
     * @param array $question
     *
     * @return book
     */
    private function editQuestion($questionID, $question)
    {
        $stmt = $this->db->prepare('UPDATE questions SET content = :content,
            correct = :correct WHERE id = :id');
        $stmt->bindValue(':content', trim($question['content']), PDO::PARAM_STR);
        $stmt->bindValue(':correct', $question['correct'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);
        $status = $stmt->execute();

        if (isset($question['delete-img'])) {
            array_map('unlink', glob(App::getRootDir().'/public/storage/'.$questionID.'_*'));
            $stmt = $this->db->prepare('UPDATE questions SET image = \'\' WHERE id = ?');
            $stmt->execute([$questionID]);
        } elseif (!empty($_FILES['image']['name'])) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                array_map('unlink', glob(App::getRootDir().'/public/storage/'.$questionID.'_*'));
                $file = App::getRootDir().'/public/storage/'.$questionID.'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $file);
            }

            $stmt = $this->db->prepare('UPDATE questions SET image = ? WHERE id = ?');
            $stmt->execute([$_FILES['image']['name'], $questionID]);
        }

        return $status;
    }

    /**
     * Edit answers in exam.
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
