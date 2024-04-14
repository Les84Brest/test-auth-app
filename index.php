<?php

declare(strict_types=1);

use TestApp\App;
use TestApp\Routing\Router;

require './vendor/autoload.php';
include __DIR__ . '/src/Helper/dev.php';

session_start();

$app = new App();
$app->run();
