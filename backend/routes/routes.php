<?php

use routes\Router;

Router::addRoute('register', ['user\RegisterController' => 'store']);
Router::addRoute('login', ['user\LoginController' => 'login']);

Router::routeGroup(['role' => 'Admin', 'prefix' => 'admin'], fn () => [
    'posts' => ['posts\PostController' => 'index'],
    'testss' => ['posts\PostController' => 'index']
]);


