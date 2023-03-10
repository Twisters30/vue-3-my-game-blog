<?php

namespace controllers;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use models\User\RefreshToken;

class TokenService
{
    public static function createAccessToken(array $user): string
    {
        $now = new \DateTimeImmutable();

        $data = [
            'iat'  => $now->getTimestamp(),
            'exp' => $now->modify(TOKEN_LIFETIME)->getTimestamp(),
            'nbf'  => $now->getTimestamp(),
            'iss'  => DOMAIN,
            'role' => strtolower($user['role_name']),
            'email' => strtolower($user['email']),
            'user_id' => $user['id']
        ];

        return JWT::encode($data, SECRET_KEY, JWT_ALGORITHM);
    }

    public static function createRefreshToken(int $userId): string
    {
        $now = new \DateTimeImmutable();

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
    public static function checkAccessToken(string $role): void
    {
        $data = self::getTokenData();

        if ($data->role !== strtolower($role)) {
            throw new Exception('Маршрут не доступен для вашей роли', 403);
        }
    }

    public static function getTokenData(): object
    {
        $jwt = self::parseToken();

        return self::decodeToken($jwt);
    }

    /**
     * @throws Exception
     */
    private static function decodeToken(string $jwt): object
    {
        try {
            $data = JWT::decode($jwt, new Key(SECRET_KEY, JWT_ALGORITHM));
        } catch (ExpiredException $e) {
            throw new Exception('Токен более не валиден', 403);
        } catch (SignatureInvalidException $e) {
            throw new Exception('Недействительный токен', 403);
        } catch (Exception $e) {
            throw new Exception('Ошибка при декодировании токена', 403);
        }

        return $data;
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

    /**
     * @throws Exception
     */
    public static function checkRefreshToken(): array
    {
        $token = self::parseToken();
        $refreshTokenModel = new RefreshToken();

        $tokenWithUser = $refreshTokenModel->tokenOwner('token', $token);

        if (!$tokenWithUser) {
            throw new Exception('refresh token не валиден', 401);
        }
        return $tokenWithUser;
    }

    /**
     * @throws Exception
     */
    public static function updateTokens(): array
    {
        $tokenWithUser = self::checkRefreshToken();

        $refreshToken = self::createRefreshToken($tokenWithUser['id']);


        $refreshTokenModel = new RefreshToken();
        $refreshTokenModel->update([
            'token' => $refreshToken,
            'created_at' => date('Y-m-d H:i:s')
        ])->where('token', $tokenWithUser['token'])->execute();

        return [
            'accessToken' => self::createAccessToken($tokenWithUser),
            'refreshToken' => $refreshToken,
            'role' => $tokenWithUser['role_name'],
        ];
    }
}