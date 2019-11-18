<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\User;

/**
 * Class UserDAO
 * @package App\src\DAO
 */
class UserDAO extends DAO
{
    /**
     * Create a user with database
     * @param $row
     * @return User
     */
    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setActive($row['active']);
        $user->setRole($row['name']);
        return $user;
    }

    /**
     * Return users id in database
     * @return array
     */
    public function getUsersId()
    {
        $sql = 'SELECT id FROM user';
        $result = $this->createQuery($sql);
        $usersId = array();
        foreach ($result as $row)
        {
            $usersId[] = $row['id'];
        }
        $result->closeCursor();
        return $usersId;
    }

    /**
     * Return users in database
     * @return array
     */
    public function getUsers()
    {
        $sql = 'SELECT user.id, user.pseudo, user.createdAt, user.active, role.name FROM user INNER JOIN role ON user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row)
        {
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    /**
     * Add user in database
     * @param Parameter $post
     */
    public function register(Parameter $post)
    {
        $this->checkUser($post);
        $sql = 'INSERT INTO user (pseudo, password, createdAt, active, role_id) VALUES (?, ?, NOW(), ?, ?)';
        $this->createQuery($sql, [$post->get('pseudo'), password_hash($post->get('password'), PASSWORD_BCRYPT), 1, 2]);
    }

    /**
     * Check if a user with the same pseudo already exist in database
     * @param Parameter $post
     * @return string
     */
    public function checkUser(Parameter $post)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$post->get('pseudo')]);
        $isUnique = $result->fetchColumn();
        if($isUnique)
        {
            return 'Ce pseudo existe déjà';
        }
    }

    /**
     * Verify if user and password are ok for login in database
     * Verify also if user account is active
     * @param Parameter $post
     * @return array
     */
    public function login(Parameter $post)
    {
        $sql = 'SELECT user.id, user.role_id, user.password, user.active, role.name FROM user INNER JOIN role ON role.id = user.role_id WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$post->get('pseudo')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($post->get('password'), $result['password']);
        $isActive = $result['active'];
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid,
            'isActive' => $isActive
        ];
    }

    /**
     * Update password in database
     * @param Parameter $post
     * @param $pseudo
     */
    public function updatePassword(Parameter $post, $pseudo)
    {
        $sql = 'UPDATE user SET password = ? WHERE pseudo = ?';
        $this->createQuery($sql, [password_hash($post->get('password'), PASSWORD_BCRYPT), $pseudo]);
    }

    /**
     * Delete user in database based on pseudo
     * @param $pseudo
     */
    public function deleteAccount($pseudo)
    {
        $sql = 'DELETE FROM user WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
    }

    /**
     * Delete user in database based on id
     * @param $userId
     */
    public function deleteUser($userId)
    {
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$userId]);
    }

    /**
     * Delete articles associated to user
     * @param $userId
     */
    public function deleteAssociatedArticles($userId)
    {
        $sql = 'SELECT id FROM article WHERE user_id = ?';
        $result = $this->createQuery($sql, [$userId]);
        foreach ($result as $row)
        {
            $articleId = $row['id'];
            $articleDAO = new ArticleDAO();
            $articleDAO->deleteArticle($articleId);
        }
    }

    /**
     * Active user account
     * @param $userId
     */
    public function activeUser($userId)
    {
        $sql = 'UPDATE user SET active = 1 WHERE id = ?';
        $this->createQuery($sql, [$userId]);
    }

    /**
     * Unactive user account
     * @param $userId
     */
    public function unactiveUser($userId)
    {
        $sql = 'UPDATE user SET active = 0 WHERE id = ?';
        $this->createQuery($sql, [$userId]);
    }
}