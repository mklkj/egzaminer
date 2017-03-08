<?php

namespace Egzaminer\Controller;

class HomepageController extends AbstractController
{
    /**
     * Home page index action.
     *
     * GET /
     *
     * @return void
     */
    public function indexAction()
    {
        $this->render('front/index', [
            'title' => $this->config('homepage-header'),
        ]);
    }
}
