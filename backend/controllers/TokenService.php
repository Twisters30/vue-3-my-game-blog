<?php


namespace controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use models\User\RefreshToken;

class TokenService
{
    public static function createAccessToken(): string
    {
        $now   = new \DateTimeImmutable();

        $data = [
            'iat'  => $now->getTimestamp(),
            'exp'  => $now->modify('+1 second')->getTimestamp(),
            'nbf'  => $now->getTimestamp(),
            'iss'  => DOMAIN,
        ];

        return JWT::encode($data, SECRET_KEY, JWT_ALGORITHM);
    }

    public static function createRefreshToken(string $userId): string
    {
        $now   = new \DateTimeImmutable();

        $data = [
            'iat'  => $now->getTimestamp(),
            'nbf'  => $now->getTimestamp(),
            'iss'  => $userId,
        ];

        return JWT::encode($data, SECRET_KEY, JWT_ALGORITHM);
    }

    /**
     * @throws Exception
     */
    public static function checkAccessToken(): void
    {
        $jwt = self::parseToken();

        try {
            JWT::decode($jwt, new Key(SECRET_KEY, JWT_ALGORITHM));
        } catch (ExpiredException $exception) {
            throw new Exception('Токен более не валиден', 403);
        }
    }

    /**
     * @throws Exception
     */
    public static function parseToken(): string
    {
        $token = apache_request_headers()['Authorization'] ??
            $_SERVER['Authorization'] ??
            $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!$token) {
            throw new Exception('Ошибка авторизации', 401);
        }
        return str_replace('Bearer ', '', $token);
    }
    public static function checkRefreshToken(): int
    {
        $token = self::parseToken();
        $refreshTokenModel = new RefreshToken();

        $refreshToken = $refreshTokenModel->select()->where('token', $token)->first();
        if(!$refreshToken) {
            throw new \Exception('refresh token не валиден', 401);
        }
        return $refreshToken['id'];

    }

    /**
     * @throws \Exception
     */
    public static function updateToken(int $userId): void
    {
       $refreshTokenId = self::checkRefreshToken();

       $refreshTokenModel = new RefreshToken();
       $refreshTokenModel->delete('id', $refreshTokenId);

       echo jsonWrite([
           'accessToken' => self::createAccessToken(),
           'refreshToken' => self::createRefreshToken($userId)
       ]);
    }
}