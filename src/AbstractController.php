<?php

namespace Tester;

use Tester\Roll\TestsList;

class AbstractController
{
    public function __construct()
    {
        $list = new TestsList();
        $this->data['tests_list'] = $list->getList();
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
