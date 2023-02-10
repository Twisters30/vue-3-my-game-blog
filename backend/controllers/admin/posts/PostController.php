<?php

namespace controllers\admin\posts;

use controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $this->parseToken();
    }
}