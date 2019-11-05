<?php

namespace App\src\constraint;

/**
 * Class Constraint
 * @package App\src\constraint
 */
class Constraint
{
    /**
     * Verify not empty
     * @param $name
     * @param $value
     * @return string
     */
    public function notBlank($name, $value)
    {
        if(empty($value))
        {
            return 'Ce champ est obligatoire';
        }
    }

    /**
     * Verify minimum length
     * @param $name
     * @param $value
     * @param $minSize
     * @return string
     */
    public function minLength($name, $value, $minSize)
    {
        if(strlen($value) < $minSize)
        {
            return 'Ce champ doit contenir au moins ' . $minSize . ' caractères';
        }
    }

    /**
     * Verify maximum length
     * @param $name
     * @param $value
     * @param $maxSize
     * @return string
     */
    public function maxLength($name, $value, $maxSize)
    {
        if(strlen($value) > $maxSize)
        {
            return 'Ce champ doit contenir au maximum ' . $maxSize . ' caractères';
        }
    }

    /**
     * Verify is email
     * @param $name
     * @param $value
     * @return string
     */
    public function isEmail($name, $value)
    {
        if (!preg_match( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $value ) )
        {
            return 'Cet email n\'est pas valide';
        }
    }
}