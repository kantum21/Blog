<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Article;

/**
 * Class ArticleDAO
 * @package App\src\DAO
 */
class ArticleDAO extends DAO
{
    /**
     * Create an article with database data
     * @param $row
     * @return Article
     */
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setHead($row['head']);
        $article->setContent($row['content']);
        $article->setUserId($row['user_id']);
        $article->setAuthor($row['pseudo']);
        $article->setCreatedAt($row['createdAt']);
        $article->setUpdatedAt($row['updatedAt']);
        return $article;
    }

    /**
     * Give articles
     * @return array
     */
    public function getArticles()
    {
        $sql = 'SELECT article.id, article.title, article.head, article.content, user.id as user_id, user.pseudo, article.createdAt, article.updatedAt FROM article INNER JOIN user ON article.user_id = user.id ORDER BY article.updatedAt DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row)
        {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    /**
     * Give an article
     * @param $articleId
     * @return Article
     */
    public function getArticle($articleId)
    {
        $sql = 'SELECT article.id, article.title, article.head, article.content, user.id as user_id, user.pseudo, article.createdAt, article.updatedAt FROM article INNER JOIN user ON article.user_id = user.id WHERE article.id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }

    /**
     * Add an article in database
     * @param Parameter $post
     * @param $userId
     */
    public function addArticle(Parameter $post, $userId)
    {
        $sql = 'INSERT INTO article (title, head, content, createdAt, updatedAt, user_id) VALUES (?, ?, ?, NOW(), NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $post->get('head'), $userId]);
    }

    /**
     * Update an article in database
     * @param Parameter $post
     * @param $articleId
     */
    public function editArticle(Parameter $post, $articleId)
    {
        $sql = 'UPDATE article SET title=:title, head=:head, content=:content, updatedAt=NOW(), user_id=:user_id WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'head' => $post->get('head'),
            'content' => $post->get('content'),
            'user_id' => $post->get('user_id'),
            'articleId' => $articleId
        ]);
    }

    /**
     * Delete an article in database
     * @param $articleId
     */
    public function deleteArticle($articleId)
    {
        $sql = 'DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$articleId]);
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }
}