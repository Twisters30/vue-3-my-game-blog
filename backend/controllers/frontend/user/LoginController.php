<?php

namespace controllers\frontend\user;

use controllers\BaseController;
use models\User\User;

class LoginController extends BaseController
{
    public function login($request)
    {
        $this->allowMethod('post');

        $user = new User();
        $isUser = $user->select()
            ->where('email', $request['email'])
            ->first();

        if (!$isUser ||
            !password_verify($request['password'], $isUser['password']))
        {
            http_response_code(404);
            echo jsonWrite(['error' => 'Пользователь или пароль не совпадают']);
            exit();
        }

        $token = $this->createToken();

        $user->update(['token' => $token])->execute();

        echo jsonWrite(['token' => $token]);
    }

    public function logout()
    {

    }
}