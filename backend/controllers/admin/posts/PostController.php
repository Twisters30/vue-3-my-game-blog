<?php

namespace controllers\admin\posts;

use controllers\BaseController;
use Exception;
use controllers\TokenService;
use models\Post\PostStatus;
use services\interfaces\image_compression\ImageCompressionInterface;
use services\ServiceContainer;

class PostController extends BaseController
{
    private ImageCompressionInterface $compressor;

    /**
     * @throws Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        TokenService::checkAccessToken($this->route['attributes']['role']);
        $this->compressor = ServiceContainer::getService(ImageCompressionInterface::class);
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

        $result = $this->compressor->compress($_FILES['image']['tmp_name']);

        dd(1, $_POST, $_FILES);

    }
}