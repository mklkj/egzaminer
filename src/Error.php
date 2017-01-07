<?php

namespace Egzaminer;

class Error extends Controller
{
    public function showAction($code = 404)
    {
        http_response_code($code);

        $this->render('error', ['title' => 'Error '.$code]);
    }
}
