<?php

use Tester\Tester;

include __DIR__.'/../vendor/autoload.php';

$tester = new Tester($configFile = dirname(__DIR__).'/config.php');

if (isset($_GET['test'])) {
    $tests = $tester->getTestsList();
    $data = $tester->getTest($_GET['test']);

    include __DIR__.'/templates/test.html.php';
} else {
    $tests = $tester->getTestsList();

    include __DIR__.'/templates/list.html.php';
}
