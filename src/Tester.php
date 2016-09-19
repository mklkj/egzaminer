<?php

namespace Tester;

use Tester\Model\TestsList;
use Tester\Model\OneTest;
use Tester\Model\Questions;
use Tester\Model\Answers;

class Tester
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var PDO
     */
    private $db;

    /**
     * Constructor.
     *
     * @param string $config Path to config file.
     */
    public function __construct($config)
    {
        if (is_array($config)) {
            $this->config = $config;
        } elseif (!file_exists($config)) {
            throw new \Exception('Config file does not exists!');
        }
        $this->config = include $config;

        $this->databaseConnect();
    }

    private function databaseConnect()
    {
        $dsn = 'mysql:dbname='.$this->config['db']['name'].';host='.$this->config['db']['host'].';charset=utf8';
        $user = $this->config['db']['user'];
        $password = $this->config['db']['pass'];

        $this->db = new \PDO($dsn, $user, $password);
    }

    /**
     * Get tests list.
     *
     * @return array
     */
    public function getTestsList()
    {
        $list = new TestsList($this->db);

        return $list->getList();
    }

    /**
     * Get one test and questions.
     *
     * @param int $id Test id.
     *
     * @return array
     */
    public function getTest($id)
    {
        $test = (new OneTest($this->db))->getInfo($id);

        if (false === $test) {
            throw new TestNotExists('Test not exists!');
        }

        $questions = (new Questions($this->db))->getByTestId($id);
        $answers = (new Answers($this->db))->getAnswersByQuestions($questions);

        return array(
            'title' => $test['title'],
            'questions' => $questions,
            'answers' => $answers,
        );
    }

    /**
     * Get one test with data to check it.
     *
     * @param array $post
     * @param int   $id
     *
     * @return array
     */
    public function getTestCheck($post, $id)
    {
        $oneTest = new OneTest($this->db);
        $questions = new Questions($this->db);
        $answers = new Answers($this->db);
        $testStat = new TestStat();

        $testInfo = $oneTest->getInfo($id);

        if (false === $testInfo) {
            throw new TestNotExists('Test not exists!');
        }

        $questionsList = $questions->getByTestId($id);
        $answersList = $answers->getAnswersByQuestions($questionsList);
        $stats = $testStat->getStats($testInfo, $questionsList, $post);

        return array(
            'test' => $testInfo,
            'questions' => $questionsList,
            'answers' => $answersList,
            'stats' => $stats,
        );
    }
}
