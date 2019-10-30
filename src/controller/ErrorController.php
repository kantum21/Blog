<?php

namespace App\src\controller;

/**
 * Class ErrorController
 * @package App\src\controller
 */
class ErrorController extends Controller
{
    /**
     * Display 404
     */
    public function errorNotFound()
    {
        echo $this->twig->render('error_404.html.twig');
    }

    /**
     * Display  error page for server errors
     */
    public function errorServer()
    {
        echo $this->twig->render('error_500.html.twig');
    }
}