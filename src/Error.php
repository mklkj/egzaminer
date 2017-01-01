<?php

namespace Egzaminer;

class Error extends Controller
{
    public function __construct($code)
    {
        $this->code = $code;
        parent::__construct();
    }

    public function showAction()
    {
        http_response_code($this->code);
        $this->render('error', ['title' => 'Error '.$this->code]);
    }
}
