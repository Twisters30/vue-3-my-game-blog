<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once ROOT . 'helpers/helpers.php';
require_once ROOT . 'routes/routes.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,HEAD,PUT,PATCH,POST,DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Expose-Headers: *');
header('Access-Control-Request-Method: *');

//preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

new \controllers\AppController();


