<?php

use routes\Router;



Router::addRoute('api/register',
    ['controller' => 'frontend\user\RegisterController', 'action' => 'store', 'method' => 'post']
);
Router::addRoute('api/login',
    ['controller' => 'frontend\user\LoginController', 'action' => 'login', 'method' => 'post']
);
Router::addRoute('api/logout',
    ['controller' => 'frontend\user\LoginController', 'action' => 'logout', 'method' => 'post']
);
Router::addRoute('api/refresh',
    ['controller' => 'frontend\user\LoginController', 'action' => 'reissueTokens', 'method' => 'post']
);
Router::addRoute('api/posts',
    ['controller' => 'frontend\MainPageController', 'action' => 'getPosts']
);

Router::routeGroup(['role' => 'Admin', 'prefix' => 'api/admin', 'namespace' => 'admin'], fn () => [
    'posts' => [
        'controller' =>'posts\PostController', 'action' => 'index'
    ],
    'posts/post-statuses' => [
        'controller' =>'posts\PostController', 'action' => 'getPostStatuses'
    ],
    'posts/create-or-update' => [
        'controller' =>'posts\PostController', 'action' => 'createOrUpdate', 'method' => 'post'
    ],
    'posts/delete' => [
        'controller' =>'posts\PostController', 'action' => 'delete', 'method' => 'delete'
    ],
    'posts/change-status' => [
        'controller' =>'posts\PostController', 'action' => 'changeStatus', 'method' => 'post'
    ],
]);

Router::addRoute('{any}',
    ['controller' => 'frontend\MainPageController', 'action' => 'index']
);




