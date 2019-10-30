<?php

namespace App\src\DAO;

use PDO;
use Exception;

/**
 * Class DAO
 * @package App\src\DAO
 */
abstract class DAO
{

    /**
     * @var PDO
     */
    private $connection;

    /**
     * @return PDO
     */
    private function checkConnection()
    {
        if($this->connection === null)
        {
            return $this->getConnection();
        }
        return $this->connection;
    }

    /**
     * @return PDO
     */
    private function getConnection()
    {
        try{
            $this->connection = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        }
        catch(Exception $errorConnection)
        {
            die ('Erreur de connection :'.$errorConnection->getMessage());
        }

    }

    /**
     * Execute a statement with or without parameters
     * @param $sql
     * @param null $parameters
     * @return bool|false|\PDOStatement
     */
    protected function createQuery($sql, $parameters = null)
    {
        if($parameters)
        {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($parameters);
            return $result;
        }
        $result = $this->checkConnection()->query($sql);
        return $result;
    }
}