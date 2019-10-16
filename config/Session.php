<?php

namespace App\config;

/**
 * Class Session
 * @package App\config
 */
class Session
{
    /**
     * @var array
     */
    private $session;

    /**
     * Session constructor.
     * @param $session array
     */
    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * Set an entry in $_SESSION
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Return value according to $name
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    /**
     * Return a value of $_SESSION according to $name after removing this entry
     * @param $name
     * @return mixed
     */
    public function show($name)
    {
        if(isset($_SESSION[$name]))
        {
            $key = $this->get($name);
            $this->remove($name);
            return $key;
        }
    }

    /**
     * Unset an entry
     * @param $name
     */
    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    /**
     * Launch session
     */
    public function start()
    {
        session_start();
    }

    /**
     * Stop session
     */
    public function stop()
    {
        session_destroy();
    }
}