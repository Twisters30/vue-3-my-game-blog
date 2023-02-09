<?php


namespace controllers\user;


use controllers\BaseController;

class LoginController extends BaseController
{
    public function login()
    {
        $this->allowMethod('POST');
    }
}