<?php

namespace controllers\frontend;

use controllers\BaseController;
use models\Post\Post;

class MainPageController extends BaseController
{
    private Post $postModel;
    public function __construct($route)
    {
        parent::__construct($route);

        $this->postModel = new Post();
    }

    public function index()
    {
        header("Content-Type: text/html");
        return require(ROOT.'/public/main.php');

//      echo jsonWrite($this->postModel->activePostsWithAuthor());
    }
}