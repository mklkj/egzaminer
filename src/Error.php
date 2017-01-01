<?php

namespace Egzaminer;

class Error
{
    public function __construct($code)
    {
        $this->code = $code;
    }

    public function showAction()
    {
        http_response_code($this->code);
        echo 'Error '.$this->code;
    }
}
