<?php

use routes\Router;

Router::add('admin/posts/{id}/edit', ['posts\PostController' => 'index']);
Router::add('posts/{id}/edit', ['posts\PostController' => 'edit']);
Router::add('admin/posts/{id}', ['posts\PostController' => 'index']);
Router::add('posts/{id}', ['posts\PostController' => 'show']);
Router::add('posts', ['posts\PostController' => 'index']);

