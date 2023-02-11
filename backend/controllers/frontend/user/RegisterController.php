<?php

namespace controllers\frontend\user;
use controllers\BaseController;
use models\User\User;

class RegisterController extends BaseController
{
    public function store($request): void
    {
        $this->allowMethod('POST');

        $user = new User();
        $checkUser = $user->select()->where('email', $request['email'])->first();

        if ($checkUser) {
            http_response_code(400);
            echo json_encode(
                ['error' => "Пользователь {$request['email']} уже существует"],
                JSON_UNESCAPED_UNICODE
            );
            new \Exception();
        }

        $request['password'] = phash($request['password']);
        $newUser = $user->create($request);

        echo json_encode($newUser);
    }
}