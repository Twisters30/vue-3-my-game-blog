<?php

namespace controllers\frontend\posts;

use controllers\BaseController;
use models\Post\Post;

class PostController extends BaseController
{
    public function index()
    {
        $postModel = new Post();

        echo dirname(__DIR__).'\db\migrations';

    }
}