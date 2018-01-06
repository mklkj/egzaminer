<?php

namespace Egzaminer\Tests\Model;

use PDO;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

abstract class EgzaminerTestsDatabaseTestCase extends TestCase
{
    use TestCaseTrait;

    /**
     * only instantiate pdo once for test clean-up/fixture load
     * @var PDO
     */
    protected static $pdo;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo === null) {
                self::$pdo = new PDO('sqlite::memory:');
                self::$pdo->exec('
                    CREATE TABLE `answers` (
                      `id` INTEGER PRIMARY KEY,
                      `exam_id` int(10),
                      `question_id` int(10),
                      `content` varchar(512));

                    CREATE TABLE `exams_groups` (
                      `id` INTEGER PRIMARY KEY,
                      `title` varchar(255),
                      `description` text);

                    CREATE TABLE `questions` (
                      `id` INTEGER PRIMARY KEY,
                      `exam_id` int(10),
                      `content` text,
                      `image` varchar(255),
                      `correct` int(10));

                    CREATE TABLE `exams` (
                      `id` INTEGER PRIMARY KEY,
                      `group_id` int(10),
                      `title` varchar(255),
                      `questions` int(10),
                      `threshold` int(10));

                    ALTER TABLE `answers` ADD PRIMARY KEY (`id`);
                    ALTER TABLE `answers` MODIFY `id` int(10);

                    ALTER TABLE `exams_groups` ADD PRIMARY KEY (`id`);
                    ALTER TABLE `exams_groups` MODIFY `id` int(10);

                    ALTER TABLE `questions` ADD PRIMARY KEY (`id`);
                    ALTER TABLE `questions` MODIFY `id` int(10);

                    ALTER TABLE `exams` ADD PRIMARY KEY `id` (`id`);
                    ALTER TABLE `exams` MODIFY `id` int(10);
                ');
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, ':memory:');
        }

        return $this->conn;
    }
}
