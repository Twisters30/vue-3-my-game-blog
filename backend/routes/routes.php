<?php

use routes\Router;

Router::add('posts', ['posts\PostController' => 'index']);
Router::add('register', ['user\RegisterController' => 'store']);


