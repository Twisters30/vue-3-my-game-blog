<?php

use routes\Router;

Router::addRoute('posts', ['posts\PostController' => 'index']);
Router::addRoute('register', ['user\RegisterController' => 'store']);
Router::addRoute('login', ['login\LoginController' => 'login']);

Router::routeGroup(['role' => 'Admin', 'prefix' => 'admin'], fn () => [
    'posts' => ['posts\PostController' => 'index'],
    'test' => ['posts\PostController' => 'index']
] );

