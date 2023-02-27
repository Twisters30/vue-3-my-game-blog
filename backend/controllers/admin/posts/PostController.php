<?php

namespace controllers\admin\posts;

use controllers\BaseController;
use Exception;
use controllers\TokenService;
use models\Post\PostStatuses;

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
    public function getPostStatuses(): void
    {
        $this->allowMethod();
        $postStatusesModel = new PostStatuses();
        echo jsonWrite($postStatusesModel->all());
    }
    public function store():void
    {
        $this->allowMethod('POST');
        dd(1, $_POST, $_FILES);
    }
}