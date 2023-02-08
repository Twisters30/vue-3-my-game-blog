<?php

namespace controllers\posts;

use controllers\BaseController;
use models\Post\Post;

class PostController extends BaseController
{
    public function index()
    {
        $postModel = new Post();

        dd(1, $postModel->executeRaw("SELECT * FROM users"));

        $result = $postModel->update(['name' => 'john'])->where('id', 5)->execute();

        //dd(1, $result);

    }
}