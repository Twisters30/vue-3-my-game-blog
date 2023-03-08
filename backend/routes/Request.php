<?php

namespace routes;

class Request
{
    private static array $data;
    public function __construct()
    {
        self::$data = array_merge(
            $_POST ?? [],
            $_FILES ?? [],
            json_decode(file_get_contents('php://input'), true) ?? []
        );

        foreach (self::$data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __set($name, $value) {
        return $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name ?? '';
    }

    public function __unset($name) {
        if (isset($name)) {
            unset($this->$name);
        }
    }

    public function files(): array
    {
        return $_FILES;
    }

    public function only(...$inputs): array
    {
        $result = [];

        foreach ($inputs as $input) {
            $result[$input] = $this->$input;
        }

        return $result;
    }

    public function except(...$inputs): array
    {
        $result = [];

        foreach (self::$data as $key => $value) {
            if (!in_array($key, $inputs)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    public function all(): array
    {
        return self::$data;
    }
}