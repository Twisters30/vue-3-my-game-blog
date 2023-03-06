<?php

namespace controllers\admin\posts;

use controllers\BaseController;
use Exception;
use controllers\TokenService;
use models\Post\Post;
use models\Post\PostStatus;
use routes\Request;
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
    public function store(Request $request): void
    {
        $this->allowMethod('post');
        $tokenData = TokenService::getTokenData();

        $result = $request->htmlEncode('name', 'description');
        $result['post_status_id'] = $request->post_status_id;
        $result['user_id'] = $tokenData->user_id;

        foreach ($request->files() as $key => $file) {
            $result[$key] = $this->compressor->compress($file, $tokenData->email);
        }

        $postModel = new Post();
        $postModel->create($result);
    }

    /**
     * @throws Exception
     */
    public function delete(Request $request): void
    {
        $this->allowMethod('delete');
    }
}