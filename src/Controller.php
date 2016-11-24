<?php

namespace Egzaminer;

use Egzaminer\Admin\Auth;
use Egzaminer\Roll\ExamsGroupModel;

class Controller
{
    public function __construct()
    {
        $this->auth = new Auth();
        $this->dir = App::getDir();
        $this->root = App::getRootDir();

        $config = include $this->root.'/config.php';
        $this->config = $config['site'];

        $list = new ExamsGroupModel();
        $this->data['exams_groups'] = $list->getExamsGroups();

        // flash validation messages
        $this->data['valid'] = null;
        if (isset($_SESSION['valid'])) {
            if (true === $_SESSION['valid']) {
                $this->data['valid'] = true;
            } else {
                $this->data['valid'] = false;
            }
            unset($_SESSION['valid']);
        }

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    /**
     * Check is user logged.
     *
     * @return bool Return true, if logged
     */
    public function isLogged()
    {
        return $this->auth->isLogged();
    }

    public function render($templateName, $title = '')
    {
        $this->title = $title;
        $this->siteTitle = $this->config['title'];
        $this->pageTitle = $title.' '.$this->config['title_divider'].' '.$this->siteTitle;

        include $this->root.'/web/themes/'.$this->config['theme'].'/templates/'.$templateName.'.html.php';
    }

    public function dir()
    {
        return $this->dir;
    }

    public function escape($string)
    {
        return htmlspecialchars($string);
    }
}
