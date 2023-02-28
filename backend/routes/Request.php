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

    public function input(...$inputs): Request
    {
        $this->unsetProperties($inputs);

        return $this;
    }

    public function files(): Request
    {
        $this->unsetProperties(array_keys($_FILES));

        return $this;
    }

    private function unsetProperties($properties): void
    {
        foreach (self::$data as $key => $value) {
            if (!in_array($key, $properties)) {
                unset($this->$key);
            }
        }
    }
}