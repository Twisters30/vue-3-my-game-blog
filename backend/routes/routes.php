<?php

use routes\Router;


Router::addRoute('register', ['controller' => 'frontend\user\RegisterController', 'action' => 'store']);
Router::addRoute('login', ['controller' => 'frontend\user\LoginController', 'action' => 'login']);
Router::addRoute('logout', ['controller' => 'frontend\user\LoginController', 'action' => 'logout']);
Router::addRoute('refresh', ['controller' => 'frontend\user\LoginController', 'action' => 'reissueTokens']);
Router::addRoute('posts', ['controller' => 'frontend\posts\PostController', 'action' => 'index']);

Router::routeGroup(['role' => 'Admin', 'prefix' => 'admin', 'namespace' => 'admin'], fn () => [
    'posts' => ['controller' =>'posts\PostController', 'action' => 'index'],
    'testss' => ['controller' =>'posts\PostController', 'action' => 'index']
]);




