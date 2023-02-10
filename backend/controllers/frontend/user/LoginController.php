<?php

namespace controllers\frontend\user;

use controllers\BaseController;

class LoginController extends BaseController
{
    public function login()
    {
        $this->allowMethod('POST');
    }
}