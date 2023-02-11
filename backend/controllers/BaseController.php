<?php

namespace controllers;

use Exception;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;


abstract class BaseController
{
    public array $route = [];

    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * @throws Exception
     */
    public static function allowMethod(string $method = 'GET'): void
    {
        $upMethod = strtoupper($method);

        if ($_SERVER['REQUEST_METHOD'] != strtoupper($upMethod)) {
            throw new Exception("Недопустимый метод {$_SERVER['REQUEST_METHOD']}, необходим {$upMethod}", 405);
        }
    }

    public function createToken(): string
    {
        $issuedAt   = new \DateTimeImmutable();

        $data = [
            'iat'  => $issuedAt->getTimestamp(),
            'nbf'  => $issuedAt->getTimestamp(),
            'iss'  => DOMAIN,
        ];

        return JWT::encode($data, SECRET_KEY, JWT_ALGORITHM);
    }

    /**
     * @throws Exception
     */
    public function checkToken(): bool
    {
        $jwt = $this->parseToken();
        $now = new \DateTimeImmutable();

        try {
            $token = JWT::decode($jwt, new Key(SECRET_KEY, JWT_ALGORITHM));
        } catch (Exception $exception) {
            throw new Exception('Ошибка авторизации', 401);
        }

        if ($token->iss !== DOMAIN ||
            $token->nbf > $now->getTimestamp())
        {
            http_response_code(401);
            return false;
        }
        return true;
    }

    /**
     * @throws Exception
     */
    public function parseToken(): string
    {
        $token = apache_request_headers()['Authorization'] ??
            $_SERVER['Authorization'] ??
            $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!$token) {
            throw new Exception('Ошибка авторизации', 401);
        }
        return str_replace('Bearer ', '', $token);
    }
}