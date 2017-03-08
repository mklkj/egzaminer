<?php

namespace Egzaminer\Controller;

class ErrorController extends AbstractController
{
    /**
     * Error action.
     *
     * @param int $code Error response code.
     *
     * @return void
     */
    public function showAction($code = 404)
    {
        http_response_code($code);

        $this->render('error', ['title' => 'Error '.$code]);
    }
}
