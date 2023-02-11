<?php

namespace controllers\admin\posts;

use controllers\BaseController;

class PostController extends BaseController
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->checkToken();
    }

    public function index()
    {
        $this->allowMethod();

    }
}