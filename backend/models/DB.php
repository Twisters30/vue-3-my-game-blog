<?php

namespace models;

use controllers\SingletonTrait;

class DB
{
    public $connect;
    use SingletonTrait;

    /**
     * @throws \Exception
     */
    private function __construct()
    {
        $db = require_once ROOT . 'config/connect.php';
        $this->connect = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

        if (!$this->connect) {
            throw new \Exception(mysqli_connect_error(), 401);
        }
    }

}