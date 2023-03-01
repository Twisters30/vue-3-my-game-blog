<?php

namespace controllers\frontend\user;
use controllers\BaseController;
use Exception;
use models\User\User;
use routes\Request;

class RegisterController extends BaseController
{
    /**
     * @throws Exception
     */
    public function store(Request $request): void
    {
        $this->allowMethod('POST');

        $user = new User();
        $checkUser = $user->select()->where('email', $request->email)->first();

        if ($checkUser) {
            throw new Exception("Пользователь {$request->email} уже существует", 400);
        }

        $request->password = phash($request->password);
        $newUser = $user->create((array)$request);

        echo json_encode($newUser);
    }
}