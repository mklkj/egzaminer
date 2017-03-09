<?php

namespace Egzaminer\Controller;

class ErrorController extends AbstractController
{
    /**
     * Error action.
     *
     * @param int $code Error response code.
     *
     * @return string
     */
    public function showAction($code = 404)
    {
        http_response_code($code);

        return $this->render('error', ['title' => 'Error '.$code]);
    }
}
