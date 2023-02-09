<?php

namespace controllers\user;
use controllers\BaseController;
use models\user\User;

class RegisterController extends BaseController
{
    public function store()
    {
        $this->allowMethod('POST');
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body,true);
        $user = new User();
        $isUniqUser = $user->select()->where('email', $request['email'])->first();
        if ($isUniqUser) {
            http_response_code(400);
            echo json_encode(['errors' => 'Пользователь уже существует'], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
        $newUser = $user->create($request);
        echo json_encode($newUser);
    }
}