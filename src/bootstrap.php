<?php

use Egzaminer\App;

include dirname(__DIR__).'/vendor/autoload.php';

session_start();
session_regenerate_id();

$app = new App($_SERVER['REQUEST_URI']);
$app->invoke();
