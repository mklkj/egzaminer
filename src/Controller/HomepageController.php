<?php

namespace Egzaminer\Controller;

class HomepageController extends AbstractController
{
    /**
     * Home page index action.
     *
     * GET /
     *
     * @return string
     */
    public function indexAction()
    {
        return $this->render('front/index', [
            'title' => $this->config('homepage-header'),
        ]);
    }
}
