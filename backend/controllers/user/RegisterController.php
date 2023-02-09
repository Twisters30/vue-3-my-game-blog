<?php

namespace controllers\user;
class RegisterController
{
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != ('POST' || 'OPTIONS')) {
            http_response_code(405);
            exit('method not allowed');
        }

        $request_body = file_get_contents('php://input');

        echo $request_body;
    }
}