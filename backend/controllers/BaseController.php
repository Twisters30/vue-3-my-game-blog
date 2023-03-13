<?php

namespace controllers;

use Exception;
use models\User\User;


abstract class BaseController
{
    public array $route = [];

    public function __construct($route)
    {
        $this->route = $route;
    }
}