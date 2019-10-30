<?php

namespace App\src\controller;

use App\config\Parameter;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class FrontController
 * @package App\src\controller
 */
class FrontController extends Controller
{
    /**
     * Load articles and display home page
     */
    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        echo $this->twig->render('home.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Load an article with associated comments to display
     * @param $articleId
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function article($articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        echo $this->twig->render('single.html.twig', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    /**
     * Add comment
     * @param Parameter $post
     * @param $articleId
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function addComment(Parameter $post, $articleId)
    {
        if($post->get('submit'))
        {
            $errors = $this->validation->validate($post, 'Comment');
            if(!$errors)
            {
                $this->commentDAO->addComment($post, $articleId);
                $this->session->set('add_comment', 'Le nouveau commentaire a bien été ajouté');
                header('Location: ../public/index.php');
            }
            $article = $this->articleDAO->getArticle($articleId);
            $comments = $this->commentDAO->getCommentsFromArticle($articleId);

            echo $this->twig->render('single.html.twig', [
                'article' => $article,
                'comments' => $comments,
                'post' => $post,
                'errors' => $errors
            ]);
        }
    }

    /**
     * Flag a comment
     * @param $commentId
     */
    public function flagComment($commentId)
    {
        $this->commentDAO->flagComment($commentId);
        $this->session->set('flag_comment', 'Le commentaire a bien été signalé');
        header('Location: ../public/index.php');
    }

    /**
     * Register new user
     * @param Parameter $post
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function register(Parameter $post)
    {
        if($post->get('submit'))
        {
            $errors = $this->validation->validate($post, 'User');
            if($this->userDAO->checkUser($post))
            {
                $errors['pseudo'] = $this->userDAO->checkUser($post);
            }
            if(!$errors)
            {
                $this->userDAO->register($post);
                $this->session->set('register', 'Votre inscription a bien été effectuée');
                header('Location: ../public/index.php');
            }
            echo $this->twig->render('register.html.twig', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        else
        {
            echo $this->twig->render('register.html.twig');
        }
    }

    /**
     * Login
     * @param Parameter $post
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function login(Parameter $post)
    {
        if($post->get('submit'))
        {
            $result = $this->userDAO->login($post);
            if($result && $result['isPasswordValid'])
            {
                $this->session->set('login', 'Content de vous revoir');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['name']);
                $this->session->set('pseudo', $post->get('pseudo'));
                header('Location: ../public/index.php');
            }
            else
            {
                $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
                echo $this->twig->render('login.html.twig', [
                    'post'=> $post
                ]);
            }
        }
        else
        {
            echo $this->twig->render('login.html.twig');
        }
    }
}