<?php

namespace Egzaminer\Roll;

use Egzaminer\Controller;

class HomePage extends Controller
{
    public function indexAction()
    {
        $this->render('homepage', [
            'title' => $this->config('homepage-header'),
        ]);
    }
}
