<?php

namespace controllers\posts;

use controllers\BaseController;
use models\Post\Post;

class PostController extends BaseController
{
    public function index()
    {
        $postModel = new Post();

    }
}