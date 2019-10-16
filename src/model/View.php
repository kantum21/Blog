<?php

namespace App\src\model;

use App\config\Request;

/**
 * Class View
 * @package App\src\model
 */
class View
{
    /**
     * @var string
     */
    private $file;
    /**
     * @var string
     */
    private $title;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var \App\config\Session
     */
    private $session;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->session = $this->request->getSession();
    }

    /**
     * Render page
     * @param $template
     * @param array $data
     */
    public function render($template, $data = [])
    {
        $this->file = '../templates/'.$template.'.php';
        $content  = $this->renderFile($this->file, $data);
        $view = $this->renderFile('../templates/base.php', [
            'title' => $this->title,
            'content' => $content,
            'session' => $this->session
        ]);
        echo $view;
    }

    /**
     * Call by render for displaying
     * @param $file
     * @param $data
     * @return false|string
     */
    private function renderFile($file, $data)
    {
        if(file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        header('Location: index.php?route=notFound');
    }
}