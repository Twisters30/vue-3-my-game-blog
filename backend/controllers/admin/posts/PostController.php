<?php

namespace controllers\admin\posts;

use controllers\BaseController;
use Exception;
use controllers\TokenService;
use models\Post\PostStatus;
use services\interfaces\image_compression\imageCompressionInterface;
use services\ServiceContainer;

class PostController extends BaseController
{
    public imageCompressionInterface $compressor;

    /**
     * @throws Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        TokenService::checkAccessToken($this->route['attributes']['role']);
        $this->compressor = ServiceContainer::getService(imageCompressionInterface::class);
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $this->allowMethod();
    }

    /**
     * @throws Exception
     */
    public function getPostStatuses(): void
    {
        $this->allowMethod();

        $postStatusesModel = new PostStatus();

        echo jsonWrite($postStatusesModel->all());
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        $this->allowMethod('post');

        $result = $this->compressor->compress($_FILES['image']);
        dd(1, $_POST, $_FILES, $result);

    }
}