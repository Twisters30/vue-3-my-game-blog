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
use validation\interfaces\ValidatorInterface;

class PostController extends BaseController
{
    private ImageCompressionInterface $compressor;

    private Post $postModel;
    private PostStatus $postStatusModel;

    /**
     * @throws Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        TokenService::checkAccessToken($this->route['attributes']['role']);
        $this->compressor = ServiceContainer::getService(ImageCompressionInterface::class);
        $this->postModel = new Post();
        $this->postStatusModel = new PostStatus();
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $this->allowMethod();

        echo jsonWrite($this->postModel->select()->htmlDecode());
    }

    /**
     * @throws Exception
     */
    public function getPostStatuses(): void
    {
        $this->allowMethod();

        echo jsonWrite($this->postStatusModel->all());
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): void
    {
        $this->allowMethod('post');
        $tokenData = TokenService::getTokenData();

        $result = $request->except('image', 'icon');
        $result['user_id'] = $tokenData->user_id;

        foreach ($request->files() as $key => $file) {
            $result[$key] = $this->compressor->compress($file, $tokenData->email);
        }

        $this->postModel->htmlEncode($result)
            ->create($this->postModel->encoded);
    }

    /**
     * @throws Exception
     */
    public function delete(Request $request): void
    {
        $this->allowMethod('delete');

        $this->postModel->delete('id', $request->id);
    }
}