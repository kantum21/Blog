<?php

namespace App\config;

/**
 * Class Parameter
 * @package App\config
 */
class Parameter
{
    /**
     * @var array
     */
    private $parameter;

    /**
     * Parameter constructor.
     * @param $parameter array
     */
    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * Return a value of parameter array according to a key
     * @param $name string Key of parameter array
     * @return mixed
     */
    public function get($name)
    {
        if(isset($this->parameter[$name]))
        {
            return $this->parameter[$name];
        }
    }

    /**
     * Set an entry in parameter array
     * @param $name string Key of parameter array
     * @param $value mixed
     */
    public function set($name, $value)
    {
        $this->parameter[$name] = $value;
    }


    /**
     * Return parameter array
     * @return array
     */
    public function all()
    {
        return $this->parameter;
    }

}