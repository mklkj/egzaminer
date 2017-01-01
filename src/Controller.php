<?php

namespace Egzaminer;

use Egzaminer\Admin\Auth;
use Egzaminer\Roll\ExamsGroupModel;
use Twig_Environment;
use Twig_Error_Loader;
use Twig_Loader_Filesystem;
use Twig_Error_Syntax;
use Twig_Extension_Debug;

class Controller
{
    public function __construct()
    {
        $this->auth = new Auth();
        $this->dir = App::getDir();
        $this->root = App::getRootDir();

        $this->config = include $this->root.'/config/site.php';

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

    public function dir()
    {
        return $this->dir;
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

    /**
     * @param string $template Template name
     * @param array $data Data to use in template
     */
    public function render($template, $data = [])
    {

        $loader = new Twig_Loader_Filesystem(
            $this->root.'/resources/themes/'.$this->config['theme'].'/templates/'
        );
        $twig = new Twig_Environment($loader, [
            'cache' => $this->config['cache'] ? $this->root.'/var/twig' : false,
            'debug' => $this->config['debug'] ? true : false,
        ]);
        // $twig->addExtension(new Twig_Extension_Debug());

        $data['valid'] = $this->data['valid'];
        $data['dir'] = $this->dir;
        $data['siteTitle'] = $this->config['title'];
        $data['isLogged'] = $this->isLogged();
        $data['headerTitle'] = isset($data['title']) ? $data['title'] : '';
        $data['pageTitle'] = isset($data['title'])
            ? $data['title'].' '.$this->config['title_divider'].' '.$this->config['title']
            : $this->config['title'];

        $data['examsGroups'] = (new ExamsGroupModel())->getExamsGroups();

        echo $twig->render($template.'.twig', $data);
    }
}
