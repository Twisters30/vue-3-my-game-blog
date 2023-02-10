<?php

use routes\Router;

Router::addRoute('register', ['frontend\user\RegisterController' => 'store']);
Router::addRoute('login', ['frontend\user\LoginController' => 'login']);

Router::routeGroup(['role' => 'Admin', 'prefix' => 'admin'], fn () => [
    'posts' => ['frontend\posts\PostController' => 'index'],
    'testss' => ['frontend\posts\PostController' => 'index']
]);


