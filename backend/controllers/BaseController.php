<?php

namespace controllers;

use Firebase\JWT\Key;
use Firebase\JWT\JWT;


abstract class BaseController
{
    public array $route = [];

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function allowMethod(string $method = 'GET'): void
    {
        $ucMethod = strtoupper($method);

        if ($_SERVER['REQUEST_METHOD'] != strtoupper($ucMethod)) {
            http_response_code(405);
            echo json_encode(
                ['error' => "Недопустимый метод {$_SERVER['REQUEST_METHOD']}, необходим {$ucMethod}"],
                JSON_UNESCAPED_UNICODE
            );
            new \Exception();
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

    public function checkToken(): bool
    {
        $jwt = $this->parseToken();
        $now = new \DateTimeImmutable();

        try {
            $token = JWT::decode($jwt, new Key(SECRET_KEY, JWT_ALGORITHM));
        } catch (\Exception $exception) {

            echo jsonWrite(['error' => 'Ошибка авторизации']);
            http_response_code(401);
            new \Exception();
        }

        if ($token->iss !== DOMAIN ||
            $token->nbf > $now->getTimestamp())
        {
            http_response_code(401);
            return false;
        }
        return true;
    }

    public function parseToken(): string
    {
        $token = apache_request_headers()['Authorization'] ??
            $_SERVER['Authorization'] ??
            $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!$token) {
            http_response_code(401);
            new \Exception();
        }
        return str_replace('Bearer ', '', $token);
    }
}