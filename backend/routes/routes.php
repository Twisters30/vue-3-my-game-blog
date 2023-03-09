<?php

use routes\Router;


Router::addRoute('register', ['controller' => 'frontend\user\RegisterController', 'action' => 'store']);
Router::addRoute('login', ['controller' => 'frontend\user\LoginController', 'action' => 'login']);
Router::addRoute('logout', ['controller' => 'frontend\user\LoginController', 'action' => 'logout']);
Router::addRoute('refresh', ['controller' => 'frontend\user\LoginController', 'action' => 'reissueTokens']);
Router::addRoute('', ['controller' => 'frontend\MainPageController', 'action' => 'index']);

Router::routeGroup(['role' => 'Admin', 'prefix' => 'admin', 'namespace' => 'admin'], fn () => [
    'posts' => ['controller' =>'posts\PostController', 'action' => 'index'],
    'posts/post-statuses' => ['controller' =>'posts\PostController', 'action' => 'getPostStatuses'],
    'posts/create-or-update' => ['controller' =>'posts\PostController', 'action' => 'createOrUpdate'],
    'posts/delete' => ['controller' =>'posts\PostController', 'action' => 'delete'],
    'posts/change-status' => ['controller' =>'posts\PostController', 'action' => 'changeStatus'],
]);




