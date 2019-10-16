<?php

namespace App\src\controller;

use App\config\Request;
use App\src\constraint\Validation;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\model\View;

/**
 * Class Controller
 * @package App\src\controller
 */
abstract class Controller
{
    /**
     * @var ArticleDAO
     */
    protected $articleDAO;
    /**
     * @var CommentDAO
     */
    protected $commentDAO;
    /**
     * @var UserDAO
     */
    protected $userDAO;
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var \App\config\Parameter
     */
    protected $get;
    /**
     * @var \App\config\Parameter
     */
    protected $post;
    /**
     * @var \App\config\Session
     */
    protected $session;
    /**
     * @var Validation
     */
    protected $validation;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->validation = new Validation();
        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
    }
}