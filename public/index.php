<?php

require_once './../autoload.php';
require_once './../app/Helpers/helperFunctions.php';

use App\Kernel\App;

$app = new App(__DIR__ . '/..');

$app->run();
