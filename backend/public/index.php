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
?> <!DOCTYPE html><html lang=""><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="icon" href="/favicon.ico"><script defer src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"><title>my-blog</title><link href="/css/chunk-15e70942.184bba2f.css" rel="prefetch"><link href="/css/chunk-eb715188.b362790f.css" rel="prefetch"><link href="/js/chunk-15e70942.45ef2101.js" rel="prefetch"><link href="/js/chunk-2d0c80c2.df3a1e3d.js" rel="prefetch"><link href="/js/chunk-2d0d6f02.ceccc18a.js" rel="prefetch"><link href="/js/chunk-2d20f8d6.b60be681.js" rel="prefetch"><link href="/js/chunk-8c79ba7e.246f52cd.js" rel="prefetch"><link href="/js/chunk-eb715188.1448f003.js" rel="prefetch"><link href="/css/app.0450eacb.css" rel="preload" as="style"><link href="/css/chunk-vendors.a8154426.css" rel="preload" as="style"><link href="/js/app.a191abf6.js" rel="preload" as="script"><link href="/js/chunk-vendors.0baaa720.js" rel="preload" as="script"><link href="/css/chunk-vendors.a8154426.css" rel="stylesheet"><link href="/css/app.0450eacb.css" rel="stylesheet"></head><body><noscript><strong>We're sorry but my-blog doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript><div id="app"></div><script src="/js/chunk-vendors.0baaa720.js"></script><script src="/js/app.a191abf6.js"></script></body></html>