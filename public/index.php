<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 'On');
ini_set('xdebug.trace_output_name', 'calculate_example.%t');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require '../vendor/autoload.php';

$app_dir = dirname(__DIR__) . '/app/';
$settings = require $app_dir . 'settings.php';

$container = new \Slim\Container($settings);

require $app_dir . 'dependencies.php';

$app = new \Slim\App($container);

// create a monolog channel

$log = new Logger('logger');
$log->pushHandler(new StreamHandler(dirname(__FILE__) . '/log.txt', Logger::WARNING));

require $app_dir . 'routes.php';

$app->run();