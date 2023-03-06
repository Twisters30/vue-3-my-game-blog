<?php

namespace controllers\admin\posts;

use controllers\BaseController;
use Exception;
use controllers\TokenService;
use models\Post\PostStatus;
use routes\Request;
use services\interfaces\image_compression\ImageCompressionInterface;
use services\ServiceContainer;
use models\Post\Post;
use validation\interfaces\ValidatorInterface;

class PostController extends BaseController
{
    private ImageCompressionInterface $compressor;
    private Post $postModel;
    private PostStatus $postStatusesModel;

    /**
     * @throws Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        TokenService::checkAccessToken($this->route['attributes']['role']);
        $this->compressor = ServiceContainer::getService(ImageCompressionInterface::class);
        $this->postModel = new Post();
        $this->postStatusesModel = new PostStatus();
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $this->allowMethod();
        $decodePosts = $this->postModel->htmlDecode();
        echo jsonWrite($decodePosts);
    }

    /**
     * @throws Exception
     */
    public function getPostStatuses(): void
    {
        $this->allowMethod();

        echo jsonWrite($this->postStatusesModel->all());
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

        $this->postModel->create($result);

    }

    public function delete(Request $request)
    {
        self::allowMethod('delete');

        $this->postModel->delete('id',$request->id);
    }
}