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
     * Display home page
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function home()
    {
        echo $this->twig->render('home.html.twig');
    }

    /**
     * Load articles and display homeBlog page
     */
    public function homeBlog()
    {
        $articles = $this->articleDAO->getArticles();
        echo $this->twig->render('home_blog.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Display contact form page
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function contact()
    {
        echo $this->twig->render('contact.html.twig');
    }

    /**
     * Submit message with contact form
     * @param Parameter $post
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function submitMessage(Parameter $post)
    {
        if($post->get('submit'))
        {
            $errors = $this->validation->validate($post, 'Contact');
            if($errors)
            {
                echo $this->twig->render('contact.html.twig', [
                    'errors' => $errors
                ]);
            }
            else
            {
                $this->contact->setLastName($post->get('lastName'));
                $this->contact->setFirstName($post->get('firstName'));
                $this->contact->setMail($post->get('mail'));
                $this->contact->setMessage($post->get('message'));
                $to = EMAIL;
                $subject = 'Quentin Sporn Blog - Contact';
                $message = $this->twig->render('contact_message.html.twig', [
                        'data' => $this->contact
                    ]);
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=utf-8';
                if(mail($to, $subject, $message, implode("\r\n", $headers)))
                {
                    $this->session->set('send_message', 'Le message a bien été envoyé');
                    header('Location: ../public/index.php?route=contact');
                }
            }
        }
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
                header('Location: ../public/index.php?route=homeBlog');
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
        header('Location: ../public/index.php?route=homeBlog');
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
                header('Location: ../public/index.php?route=homeBlog');
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
                header('Location: ../public/index.php?route=homeBlog');
            }
            else
            {
                $this->session->set('error_login', 'Les identifiants de connexion saisis sont incorrects');
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