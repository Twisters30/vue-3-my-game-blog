<?php

namespace controllers\frontend\user;

use controllers\BaseController;
use models\User\User;

class LoginController extends BaseController
{
    public function login($request)
    {
        $this->allowMethod('POST');
        $user = new User();
        $isUser = $user->select()
            ->where('email', $request['email'])
            ->first();
        if (!$isUser || !password_verify($request['password'],$isUser['password'])) {
            http_response_code(404);
            echo jsonWrite(['error' => 'Пароль или email не найдены!']);
            exit();
        }
        $token = $this->createToken($isUser['email']);
        $user->update(['token' => $token])->execute();
        echo jsonWrite(['token' => $token]);
//        $user->parseToken();

    }
    public function logout(): void
    {

    }
}