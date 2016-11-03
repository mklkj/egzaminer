<?php

namespace Egzaminer;

use Egzaminer\Roll\ExamsList;

class Controller
{
    public function __construct()
    {
        $list = new ExamsList();
        $this->data['tests_list'] = $list->getList();

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    public function render($templateName)
    {
        include dirname(__DIR__).'/web/templates/'.$templateName.'.html.php';
    }

    public function dir()
    {
        return App::getDir();
    }
}
