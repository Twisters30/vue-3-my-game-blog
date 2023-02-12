<?php

namespace controllers\frontend\user;

use controllers\BaseController;
use Exception;
use models\User\User;

class LoginController extends BaseController
{
    /**
     * @throws Exception
     */
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
            throw new Exception('Пользователь или пароль не совпадают', 404);
        }

        $token = $this->createToken();

        $user->update(['token' => $token])->execute();

        echo jsonWrite(['token' => $token]);
    }

    /**
     * @throws Exception
     */
    public function logout(): void
    {
        $this->allowMethod('patch');

        $user = new User();
        $token = $this->parseToken();
        $user->update(['token'=> null])->where('token', $token)->execute();
    }
}