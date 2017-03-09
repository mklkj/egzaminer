<?php

namespace Egzaminer\Model;

use PDO;

class AnswersModel extends AbstractModel
{
    /**
     * Get answers by questions (ID).
     *
     * @param array $questions
     *
     * @return array
     */
    public function getAnswersByQuestions(array $questions)
    {
        if (empty($questions)) {
            return;
        }

        $where = '';
        foreach ($questions as $key => $value) {
            $where .= ' OR question_id = :question_id_'.md5($value['id']);
        }

        $stmt = $this->db->prepare('SELECT * FROM answers WHERE '.trim($where, ' OR '));
        foreach ($questions as $key => $value) {
            $stmt->bindValue(':question_id_'.md5($value['id']), $value['id'], PDO::PARAM_INT);
        }

        $stmt->execute();

        $array = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
            $array[$value['question_id']][] = $value;
        }

        return $array;
    }

    /**
     * Get answers by one question ID.
     *
     * @param int $questionID
     *
     * @return array
     */
    public function getAnswersByOneQuestionId($questionID)
    {
        $stmt = $this->db->prepare('SELECT * FROM answers WHERE question_id = :qid');
        $stmt->bindValue(':qid', $questionID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
