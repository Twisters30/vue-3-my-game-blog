<?php

use routes\Router;
use Symfony\Component\Console\Helper\Helper;

require_once dirname(__DIR__) . '/config/init.php';
require_once ROOT . 'routes/routes.php';
require_once ROOT . 'helpers/helpers.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// echo json_encode(['test' => 'test']);

new \controllers\AppController();