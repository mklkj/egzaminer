<?php

use Tester\App;

session_start();
session_regenerate_id();

include __DIR__.'/../vendor/autoload.php';

$app = new App();
$app->invoke();
