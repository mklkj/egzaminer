<?php

namespace Egzaminer;

use Egzaminer\Roll\ExamsGroupModel;
use Exception;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Controller
{
    private $container;
    protected $data;

    public function __construct(array $container)
    {
        $this->container = $container;

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
    }

    /**
     * @param string $name Item name
     *
     * @return mixed Item from container
     */
    public function get($name)
    {
        return $this->container[$name];
    }

    /**
     * @param string $name Config name
     *
     * @return mixed Config value
     */
    public function config($name)
    {
        return $this->get('config')[$name];
    }

    /**
     * @return string
     */
    public function dir()
    {
        return $this->get('dir');
    }

    /**
     * Check is user logged.
     *
     * @return bool Return true, if logged
     */
    public function isLogged()
    {
        return $this->get('auth')->isLogged();
    }

    /**
     * @param string $template Template name
     * @param array  $data     Data to use in template
     */
    public function render($template, $data = [])
    {
        $data['valid'] = $this->data['valid'];
        $data['dir'] = $this->dir();
        $data['siteTitle'] = $this->config('title');
        $data['isLogged'] = $this->isLogged();
        $data['headerTitle'] = isset($data['title']) ? $data['title'] : '';
        $data['pageTitle'] = isset($data['title'])
            ? $data['title'].' '.$this->config('title_divider').' '.$this->config('title')
            : $this->config('title');

        $data['examsGroups'] = (new ExamsGroupModel($this->get('dbh')))->getExamsGroups();

        $loader = new Twig_Loader_Filesystem(
            $this->get('rootDir').'/resources/themes/'.$this->config('theme').'/templates/'
        );
        $twig = new Twig_Environment($loader, [
            'cache' => $this->config('cache') ? $this->get('rootDir').'/var/twig' : false,
            'debug' => $this->config('debug') ? true : false,
        ]);

        try {
            echo $twig->render($template.'.twig', $data);
        } catch (Exception $e) {
            if ($this->config('debug')) {
                echo $e->getMessage();
            } else {
                echo 'Error 500';
            }
        }
    }
}
