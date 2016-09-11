<?php

use Tester\Tester;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

include __DIR__.'/../vendor/autoload.php';

$whoops = new Whoops();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

$tester = new Tester($configFile = dirname(__DIR__).'/config.php');

if (isset($_GET['test'])) {
    $tests = $tester->getTestsList();
    $data = $tester->getTest($_GET['test']);

    include __DIR__.'/templates/test.html.php';
} else {
    $tests = $tester->getTestsList();

    include __DIR__.'/templates/list.html.php';
}
