<?php

namespace controllers\posts;

use controllers\BaseController;
use models\Post\Post;

class PostController extends BaseController
{
    public function index()
    {
        $postModel = new Post();

        dd(1, $postModel->delete('id', '5'));

        //dd(1, $result);

    }
}