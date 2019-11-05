<?php

namespace App\src\controller;

use App\config\Parameter;
use App\config\Request;
use App\config\Session;
use App\src\constraint\Validation;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\model\Contact;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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
     * @var Contact
     */
    protected $contact;
    /**
     * @var FilesystemLoader
     */
    protected $loader;
    /**
     * @var Environment
     */
    protected $twig;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Parameter
     */
    protected $get;
    /**
     * @var Parameter
     */
    protected $post;
    /**
     * @var Session
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
        $this->contact = new Contact();
        $this->validation = new Validation();
        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        $this->loader = new FilesystemLoader('../templates');
        $this->twig = new Environment($this->loader, [
            //TODO : desactivate in production
            'debug' => true,
            //TODO : activate in production 'cache' => '/path/to/compilation_cache',
        ]);
        //TODO : desactivate in production
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addGlobal('app', $this->request);
    }
}