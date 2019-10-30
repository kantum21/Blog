<?php

namespace App\src\controller;

use App\config\Parameter;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class BackController
 * @package App\src\controller
 */
class BackController extends Controller
{
    /**
     * Check if user is logged
     * @return bool
     */
    private function checkLoggedIn()
    {
        if(!$this->session->get('pseudo'))
        {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        }
        else
        {
            return true;
        }
    }

    /**
     * Check if user is logged as admin
     * @return bool
     */
    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if(!($this->session->get('role') === 'admin'))
        {
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        }
        else
        {
            return true;
        }
    }

    /**
     * Load articles, comments, users and display administration page
     */
    public function administration()
    {
        if($this->checkAdmin())
        {
            $articles = $this->articleDAO->getArticles();
            $comments = $this->commentDAO->getFlagComments();
            $users = $this->userDAO->getUsers();

            echo $this->twig->render('administration.html.twig', [
                'articles' => $articles,
                'comments' => $comments,
                'users' => $users
            ]);
        }
    }

    /**
     * Add an article
     * @param Parameter $post
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function addArticle(Parameter $post)
    {
        if($this->checkAdmin())
        {
            if ($post->get('submit'))
            {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors)
                {
                    $this->articleDAO->addArticle($post, $this->session->get('id'));
                    $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                    header('Location: ../public/index.php?route=administration');
                }
                echo $this->twig->render('add_article.html.twig', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
            else
            {
                echo $this->twig->render('add_article.html.twig');
            }
        }
    }

    /**
     * Update an article
     * @param Parameter $post
     * @param $articleId
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function editArticle(Parameter $post, $articleId)
    {
        if($this->checkAdmin())
        {
            $article = $this->articleDAO->getArticle($articleId);
            if ($post->get('submit'))
            {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors)
                {
                    $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
                    $this->session->set('edit_article', 'L\' article a bien été modifié');
                    header('Location: ../public/index.php?route=administration');
                }
                echo $this->twig->render('edit_article.html.twig', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
            else
            {
                $post->set('id', $article->getId());
                $post->set('title', $article->getTitle());
                $post->set('content', $article->getContent());
                $post->set('author', $article->getAuthor());
                echo $this->twig->render('edit_article.html.twig', [
                    'post' => $post
                ]);
            }
        }
    }

    /**
     * Delete an article
     * @param $articleId
     */
    public function deleteArticle($articleId)
    {
        if($this->checkAdmin()) {
            $this->articleDAO->deleteArticle($articleId);
            $this->session->set('delete_article', 'L\' article a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    /**
     * Delete flag for a signaled comment
     * @param $commentId
     */
    public function unflagComment($commentId)
    {
        if($this->checkAdmin()) {
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    /**
     * Delete a comment
     * @param $commentId
     */
    public function deleteComment($commentId)
    {
        if($this->checkAdmin()) {
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    /**
     * Display profile page for logged user
     */
    public function profile()
    {
        if($this->checkLoggedIn())
        {
            echo $this->twig->render('profile.html.twig');
        }
    }

    /**
     * Update user password
     * @param Parameter $post
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updatePassword(Parameter $post)
    {
        if($this->checkLoggedIn())
        {
            if ($post->get('submit'))
            {
                $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
                $this->session->set('update_password', 'Le mot de passe a été mis à jour');
                header('Location: ../public/index.php?route=profile');
            }
            echo $this->twig->render('update_password.html.twig');
        }
    }

    /**
     * Call logoutOrDelete function with logout param
     */
    public function logout()
    {
        if($this->checkLoggedIn())
        {
            $this->logoutOrDelete('logout');
        }
    }

    /**
     * Delete user and call logoutOrDelete function with delete_account param
     */
    public function deleteAccount()
    {
        if($this->checkLoggedIn())
        {
            $this->userDAO->deleteAccount($this->session->get('pseudo'));
            $this->logoutOrDelete('delete_account');
        }
    }

    /**
     * Delete user and redirect to administration page with a message confirming that user has been deleted
     * @param $userId
     */
    public function deleteUser($userId)
    {
        if($this->checkAdmin())
        {
            $this->userDAO->deleteUser($userId);
            $this->session->set('delete_user', 'L\'utilisateur a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    /**
     * Redirect to home page with appropriate message
     * @param $param
     */
    private function logoutOrDelete($param)
    {
        $this->session->stop();
        $this->session->start();
        if($param === 'logout')
        {
            $this->session->set($param, 'À bientôt');
        }
        else
        {
            $this->session->set($param, 'Votre compte a bien été supprimé');
        }
        header('Location: ../public/index.php');
    }
}