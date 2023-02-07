<?php

namespace models;

use controllers\SingletonTrait;

class DB
{
    public $connect;
    use SingletonTrait;
    private function __construct()
    {
        $db = require_once ROOT . 'config/connect.php';
        $this->connect = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

        if (!$this->connect) {
            exit('Connection error: ' . mysqli_connect_error());
        }
    }

}