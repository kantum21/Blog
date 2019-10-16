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
        if(empty($value)) {
            return '<p>Le champ '.$name.' saisi est vide</p>';
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
        if(strlen($value) < $minSize) {
            return '<p>Le champ '.$name.' doit contenir au moins '.$minSize.' caractères</p>';
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
        if(strlen($value) > $maxSize) {
            return '<p>Le champ '.$name.' doit contenir au maximum '.$maxSize.' caractères</p>';
        }
    }
}