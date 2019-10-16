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
        return $this->view->render('error_404');
    }

    /**
     * Display  error page for server errors
     */
    public function errorServer()
    {
        return $this->view->render('error_500');
    }
}