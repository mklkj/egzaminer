<?php

namespace Egzaminer;

use Egzaminer\Roll\ExamsGroupModel;
use Egzaminer\Themes\MaterialDesignLite;
use Exception;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Controller
{
    /**
     * @var array
     */
    private $container;

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param array $container
     */
    public function __construct(array $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name Item name
     *
     * @return mixed Item from container
     */
    public function get($name)
    {
        if (isset($this->container[$name])) {
            return $this->container[$name];
        }
    }

    /**
     * @param string $name Config name
     *
     * @return mixed Config value
     */
    public function config($name)
    {
        if (isset($this->get('config')[$name])) {
            return $this->get('config')[$name];
        }
    }

    /**
     * Get request variable.
     *
     * @param string $type Request type
     * @param string $name Index name. Null for all
     *
     * @return mixed
     */
    public function getFromRequest($type = 'get', $name = null)
    {
        $request = $this->get('request');

        // if unknow request type
        if (!isset($request[$type])) {
            return;
        }

        // for get all indexes from type
        if (null === $name) {
            return $request[$type];
        }

        if (isset($request[$type][$name])) {
            return $request[$type][$name];
        }
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
     * Terminate app.
     *
     * @param int $code Exit code
     *
     * @return void
     */
    public function terminate($code = 1)
    {
        exit($code);
    }

    /**
     * @param string $path    Path to redirect
     * @param string $type    Message type
     * @param mixed  $message Message content
     *
     * @return void
     */
    public function redirectWithMessage($path, $type = 'success', $message = 'Success')
    {
        switch ($type) {
            case 'success':
                $this->get('flash')->success($message);
                break;
            case 'info':
                $this->get('flash')->info($message);
                break;
            case 'warning':
                $this->get('flash')->warning($message);
                break;
            case 'error':
                $this->get('flash')->error($message);
                break;

            default:
                $this->get('flash')->error($message);
                break;
        }

        header('Location: '.$this->dir().$path);

        $this->terminate();
    }

    private function selectMessagesTemplate()
    {
        switch ($this->config('theme')) {
            case 'mdl':
                $this->get('flash')->setTemplate(new MaterialDesignLite());
                break;
        }
    }

    /**
     * @param string $template Template name
     * @param array  $data     Data to use in template
     */
    public function render($template, $data = [])
    {
        $this->selectMessagesTemplate();

        $data['version'] = $this->get('version');
        $data['dir'] = $this->dir();
        $data['flash'] = $this->get('flash')->display();
        $data['headerTitle'] = isset($data['title']) ? $data['title'] : '';
        $data['isLogged'] = $this->isLogged();
        $data['siteTitle'] = $this->config('title');
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
