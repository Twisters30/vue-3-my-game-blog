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
        $this->postModel = new Post;
    }

    public function index()
    {
        echo jsonWrite($this->postModel->activePostWithAuthor());
    }
}