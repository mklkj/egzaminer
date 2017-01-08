<?php

use Egzaminer\App;

session_start();
session_regenerate_id();

include __DIR__.'/../vendor/autoload.php';

$app = new App($_SERVER['REQUEST_URI']);
$app->invoke();
