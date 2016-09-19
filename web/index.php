<?php

use Tester\Tester;
use Tester\TestNotExists;

include __DIR__.'/../vendor/autoload.php';

$tester = new Tester($configFile = dirname(__DIR__).'/config.php');

if (isset($_GET['test'])) {
    $tests = $tester->getTestsList();

    try {
        if (isset($_POST['send'])) {
            $data = $tester->getTestCheck($_POST, $_GET['test']);
            $template = 'test-check';
        } else {
            $data = $tester->getTest($_GET['test']);
            $template = 'test';
        }
    } catch (TestNotExists $e) {
        $template = 'error';
    }
} else {
    $tests = $tester->getTestsList();
    $template = 'list';
}

include __DIR__.'/templates/'.$template.'.html.php';
