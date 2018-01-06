<?php

namespace Egzaminer\Controller;

class ErrorController extends AbstractController
{
    public function showAction(int $code = 404): string
    {
        http_response_code($code);

        return $this->render('error', ['title' => 'Error '.$code]);
    }
}
