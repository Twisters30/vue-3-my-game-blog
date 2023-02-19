<?php

namespace controllers\frontend\user;

use controllers\BaseController;
use Exception;
use models\User\User;
use controllers\TokenService;
use models\User\RefreshToken;

class LoginController extends BaseController
{
    /**
     * @throws Exception
     */
    public function login($request): void
    {
        $this->allowMethod('post');

        $userModel = new User();
        $user = $userModel->userWithRole('email', $request['email']);

        if (!$user ||
            !password_verify($request['password'], $user['password']))
        {
            throw new Exception('Пользователь или пароль не совпадают', 404);
        }
        $refreshToken = TokenService::createRefreshToken($user['id']);

        $token = new RefreshToken();
        $token->create(['token' => $refreshToken, 'user_id' => $user['id']]);

        echo jsonWrite([
            'accessToken' => TokenService::createAccessToken($user['role_name']),
            'refreshToken' => $refreshToken,
            'role' => $user['role_name']
        ]);
    }

    /**
     * @throws Exception
     */
    public function logout(): void
    {
        $this->allowMethod('post');

        $refreshToken = TokenService::parseToken();
        $refreshTokenModel = new RefreshToken();
        $refreshTokenModel->delete('token', $refreshToken);
    }

    public function reissueTokens(): void
    {
        $this->allowMethod('get');

        TokenService::updateTokens();
    }
}