<?php

namespace controllers\frontend\user;

use controllers\BaseController;
use Exception;
use models\User\User;
use controllers\TokenService;
use models\User\RefreshToken;
use routes\Request;
use validation\interfaces\ValidatorInterface;
use services\ServiceContainer;

class LoginController extends BaseController
{
    public ValidatorInterface $validator;

    public function __construct($route)
    {
        parent::__construct($route);
        $this->validator = ServiceContainer::getService(ValidatorInterface::class);
    }

    /**
     * @throws Exception
     */
    public function login(Request $request): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->allowMethod('post');

        $this->validator->validate(
            ['password' => 'randompassword'],
            config('validation\rules\login\LoginRules')
        );

        $userModel = new User();
        $user = $userModel->userWithRole('email', $request->email);

        if (!$user ||
            !password_verify($request->password, $user['password']))
        {
            throw new Exception('Пользователь или пароль не совпадают', 404);
        }
        $refreshToken = TokenService::createRefreshToken($user['id']);

        $token = new RefreshToken();
        $token->create(['token' => $refreshToken, 'user_id' => $user['id']]);

        echo jsonWrite([
            'accessToken' => TokenService::createAccessToken($user),
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

        $tokens = TokenService::updateTokens();

        setcookie ("refreshToken", $tokens['refreshToken'], time()+3600, '/');

        echo jsonWrite($tokens);
    }
}