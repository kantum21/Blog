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
     * @param $value
     * @return string
     */
    public function notBlank($value)
    {
        if(empty($value))
        {
            return 'Ce champ est obligatoire';
        }
    }

    /**
     * Verify minimum length
     * @param $value
     * @param $minSize
     * @return string
     */
    public function minLength($value, $minSize)
    {
        if(strlen($value) < $minSize)
        {
            return 'Ce champ doit contenir au moins ' . $minSize . ' caractères';
        }
    }

    /**
     * Verify maximum length
     * @param $value
     * @param $maxSize
     * @return string
     */
    public function maxLength($value, $maxSize)
    {
        if(strlen($value) > $maxSize)
        {
            return 'Ce champ doit contenir au maximum ' . $maxSize . ' caractères';
        }
    }

    /**
     * Verify is email
     * @param $value
     * @return string
     */
    public function isEmail($value)
    {
        if (!preg_match( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $value ) )
        {
            return 'Cet email n\'est pas valide';
        }
    }
}