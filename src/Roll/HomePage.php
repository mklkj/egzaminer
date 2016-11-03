<?php

namespace Egzaminer\Roll;

use Egzaminer\Controller;

class HomePage extends Controller
{
    public function indexAction()
    {
        $this->render('list', 'Testy');
    }
}
