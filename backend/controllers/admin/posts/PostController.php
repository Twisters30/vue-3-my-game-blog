<?php

namespace controllers\admin\posts;

use controllers\BaseController;
use Exception;

class PostController extends BaseController
{

    /**
     * @throws Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->checkToken();
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $this->allowMethod();
        dd(1, $this->route);
    }
}