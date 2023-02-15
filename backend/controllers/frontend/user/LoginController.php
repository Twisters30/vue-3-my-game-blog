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
        $user = $userModel->select()
            ->where('email', $request['email'])
            ->first();

        if (!$user ||
            !password_verify($request['password'], $user['password']))
        {
            throw new Exception('Пользователь или пароль не совпадают', 404);
        }
        $accessToken = TokenService::createAccessToken();
        $refreshToken = TokenService::createRefreshToken($user['id']);

        $token = new RefreshToken();
        $token->create(['token' => $refreshToken, 'user_id' => $user['id']]);

        echo jsonWrite([
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken
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
        TokenService::updateTokens();
    }
}