<?php

namespace controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
    public function parseToken(): string
    {
        $token = $_SERVER['HTTP_AUTHORIZATION'];
        dd(1,$token);
        return '';
    }
    public function checkToken(): bool
    {
        $jwt = '';
        $now = new \DateTimeImmutable();
        $token = JWT::decode($jwt, new Key(SECRET_KEY, 'HS256'));

        if ($token->iss !== DOMAIN || $token->nbf > $now->getTimestamp()) {

        }
    }
    public function createToken() :string
    {
        $issuedAt = new \DateTimeImmutable();
        $payload = [
            'iss' => DOMAIN,
            'iat' => $issuedAt->getTimestamp(),
            'nbf' => $issuedAt->getTimestamp(),
        ];

        return JWT::encode($payload, SECRET_KEY,'HS256' );
    }
}