<?php

use app\core\Router;

require '../app/lib/require.php';
require 'helpers.php';


session_start();

$router = new Router;
$router->run();
