<?php

namespace Egzaminer;

use Egzaminer\Roll\ExamsList;

class Controller
{
    public function __construct()
    {
        $this->dir = App::getDir();
        $this->root = App::getRootDir();

        $config = include $this->root.'/config.php';
        $this->config = $config['site'];

        $list = new ExamsList();
        $this->data['tests_list'] = $list->getList();

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    public function render($templateName, $title = '')
    {
        $this->title = $title;
        $this->siteTitle = $this->config['title'];
        $this->pageTitle = $title.' '.$this->config['title_divider'].' '.$this->siteTitle;

        include $this->root.'/web/templates/'.$templateName.'.html.php';
    }

    public function dir()
    {
        return $this->dir;
    }
}
