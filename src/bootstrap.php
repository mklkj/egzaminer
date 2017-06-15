<?php

use Egzaminer\App;

if (version_compare(PHP_VERSION, '7.0', '<')) {
    die('Your host needs to use PHP 7.0 or higher to run Egzaminer.');
}

include dirname(__DIR__).'/vendor/autoload.php';

session_start();
session_regenerate_id();

$app = new App($_SERVER['REQUEST_URI']);
$app->invoke();
