<?php

namespace controllers\frontend\user;
use controllers\BaseController;
use models\User\User;

class RegisterController extends BaseController
{
    public function store()
    {
        $this->allowMethod('POST');

        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);

        $user = new User();
        $checkUser = $user->select()->where('email', $request['email'])->first();

        if ($checkUser) {
            http_response_code(400);
            echo json_encode(
                ['error' => "Пользователь {$request['email']} уже существует"],
                JSON_UNESCAPED_UNICODE
            );
            exit();
        }

        $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
        $newUser = $user->create($request);

        echo json_encode($newUser);
    }
}