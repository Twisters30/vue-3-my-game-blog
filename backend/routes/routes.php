<?php

use routes\Router;

Router::addRoute('register', ['frontend\user\RegisterController' => 'store']);
Router::addRoute('login', ['frontend\user\LoginController' => 'login']);
Router::addRoute('logout', ['frontend\user\LoginController' => 'logout']);

Router::routeGroup(['role' => 'Admin', 'prefix' => 'admin'], fn () => [
    'posts' => ['admin\posts\PostController' => 'index'],
    'testss' => ['admin\posts\PostController' => 'index']
]);


