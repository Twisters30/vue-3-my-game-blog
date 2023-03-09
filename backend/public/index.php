<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once ROOT . 'helpers/helpers.php';
require_once ROOT . 'routes/routes.php';
require_once ROOT . 'services/services.php';

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
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="<%= BASE_URL %>favicon.ico">
    <title><%= htmlWebpackPlugin.options.title %></title>
</head>
<body>
<noscript>
    <strong>We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>
<div id="app"></div>
<!-- built files will be auto injected -->
</body>
</html>



