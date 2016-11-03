<?php

namespace Egzaminer\Question;

use PDO;
use Egzaminer\Model;

class Answers extends Model
{
    public function getAnswersByQuestions($answers)
    {
        $where = '';
        foreach ($answers as $key => $value) {
            $where .= ' OR question_id = :question_id_'.md5($value['id']);
        }

        $stmt = $this->db->prepare('SELECT * FROM answers WHERE '.trim($where, ' OR '));
        foreach ($answers as $key => $value) {
            $stmt->bindValue(':question_id_'.md5($value['id']), $value['id'], PDO::PARAM_INT);
        }

        $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
            $array[$value['question_id']][] = $value;
        }

        if (!isset($array)) {
            return;
        }

        return $array;
    }

    public function getAnswersByOneQuestionId($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM answers WHERE question_id = :qid');
        $stmt->bindValue(':qid', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
