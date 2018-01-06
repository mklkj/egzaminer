<?php

namespace Egzaminer\Model;

use PDO;

class QuestionEditModel extends AbstractModel
{
    public function edit(int $questionID, array $post, array $thumbUpload, string $rootDir): bool
    {
        return $this->editQuestion($questionID, $post['question'], $thumbUpload, $rootDir)
        && $this->editAnswers($post['answers']);
    }

    private function editQuestion(int $questionID, array $question, array $thumbUpload, string $rootDir)
    {
        $stmt = $this->db->prepare('UPDATE questions SET content = :content,
            correct = :correct WHERE id = :id');
        $stmt->bindValue(':content', trim($question['content']));
        $stmt->bindValue(':correct', $question['correct'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);
        $status = $stmt->execute();

        if (isset($question['delete-img'])) {
            array_map('unlink', glob($rootDir.'/public/storage/'.$questionID.'_*'));
            $stmt = $this->db->prepare('UPDATE questions SET image = \'\' WHERE id = ?');
            $stmt->execute([$questionID]);
        } elseif (!empty($thumbUpload['name'])) {
            if (is_uploaded_file($thumbUpload['tmp_name'])) {
                array_map('unlink', glob($rootDir.'/public/storage/'.$questionID.'_*'));
                $file = $rootDir.'/public/storage/'.$questionID.'_'.$thumbUpload['name'];
                move_uploaded_file($thumbUpload['tmp_name'], $file);
            }

            $stmt = $this->db->prepare('UPDATE questions SET image = ? WHERE id = ?');
            $stmt->execute([$thumbUpload['name'], $questionID]);
        }

        return $status;
    }

    private function editAnswers(array $answers): bool
    {
        $stmt = $this->db->prepare('UPDATE answers SET content = :content
            WHERE id = :id');
        $this->db->beginTransaction();

        foreach ($answers as $key => $value) {
            $stmt->bindValue(':content', trim($value));
            $stmt->bindValue(':id', $key, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $this->db->commit();
    }
}
