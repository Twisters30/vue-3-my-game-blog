<?php

namespace controllers\admin\posts;

use controllers\BaseController;
use Exception;
use controllers\TokenService;

class PostController extends BaseController
{

    /**
     * @throws Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        TokenService::checkAccessToken($this->route['attributes']['role']);
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $this->allowMethod();
    }
    public function create(): void
    {
        $this->allowMethod();
        echo jsonWrite([
           'postStatuses' => ''
        ]);
    }
}