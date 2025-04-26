<?php

require __DIR__ . '/../vendor/autoload.php';
$autoload = include __DIR__ . '/../vendor/composer/autoload_psr4.php';
//require __DIR__ . '/../config/Config.php';
//require __DIR__ . '/../config/DatabaseConfig.php';

//require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../helper.php';

use CurrencyService\Core\Router;
use CurrencyService\Core\Request;
$router = new Router();
$request = new Request();

$router->get('/', [\CurrencyService\Controllers\CurrencyController::class, 'index']);
$router->post('/base', [\CurrencyService\Controllers\CurrencyController::class, 'changeBaseCurrency']);
$router->get('/visitors', [\CurrencyService\Controllers\VisitorController::class, 'getVisitors']);

//dd($request);

$router->resolve($request);