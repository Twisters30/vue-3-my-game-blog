<?php
require_once dirname(__DIR__) . '/config/init.php';
require_once ROOT . 'helpers/helpers.php';
require_once ROOT . 'routes/routes.php';
require_once ROOT . 'services/services.php';
//header('Content-Type: application/json; charset=utf-8');
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
<head><link href="/css/chunk-0dc07014.79cde76d.css" rel="prefetch"><link href="/css/chunk-557ab8c2.4e0f4614.css" rel="prefetch"><link href="/js/chunk-0dc07014.e3c8e42d.js" rel="prefetch"><link href="/js/chunk-2d0c80c2.1c53eeac.js" rel="prefetch"><link href="/js/chunk-2d0d6f02.392ceef0.js" rel="prefetch"><link href="/js/chunk-2d20f8d6.53adac9d.js" rel="prefetch"><link href="/js/chunk-557ab8c2.15d4d9d6.js" rel="prefetch"><link href="/css/app.8fd74daa.css" rel="preload" as="style"><link href="/css/chunk-vendors.dc94cbcf.css" rel="preload" as="style"><link href="/js/app.0250b635.js" rel="preload" as="script"><link href="/js/chunk-vendors.c8da0d9b.js" rel="preload" as="script"><link href="/css/chunk-vendors.dc94cbcf.css" rel="stylesheet"><link href="/css/app.8fd74daa.css" rel="stylesheet"></head>Html Webpack Plugin:<pre>
