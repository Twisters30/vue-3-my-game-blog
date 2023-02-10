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
            exit();
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
        $jwt = 'token from header';
        $now = new DateTimeImmutable();

        $token = JWT::decode($jwt, new Key(SECRET_KEY, JWT_ALGORITHM));

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
        return str_replace('Bearer ', '', apache_request_headers()['Authorization']);
    }
}