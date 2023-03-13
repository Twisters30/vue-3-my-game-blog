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
        echo jsonWrite($this->postModel->select()->htmlDecode());
    }

    /**
     * @throws Exception
     */
    public function createOrUpdate(Request $request): void
    {
        $tokenData = TokenService::getTokenData();
        $result = $request->all();

        if ($request->files()) {
            foreach ($request->files() as $key => $file) {
                $result[$key] = $this->compressor->compress($file, $tokenData->email);
            }
        }

        if ($request->id) {
            $this->postModel->htmlEncode($result)
                ->update($this->postModel->encoded)
                ->where('id', $request->id)
                ->execute();
        } else {
            $result['user_id'] = $tokenData->user_id;

            $this->postModel->htmlEncode($result)
                ->create($this->postModel->encoded);
        }
    }

    /**
     * @throws Exception
     */
    public function delete(Request $request): void
    {
        $this->postModel->delete('id', $request->id);
    }

    /**
     * @throws Exception
     */
    public function getPostStatuses(): void
    {
        echo jsonWrite($this->postStatusModel->all());
    }

    public function changeStatus(Request $request): void
    {
        $this->postModel
            ->update($request->only('post_status_id'))
            ->where('id', $request->id)
            ->execute();
    }
}