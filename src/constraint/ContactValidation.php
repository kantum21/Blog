<?php

namespace App\src\constraint;
use App\config\Parameter;

/**
 * Class ContactValidation
 * @package App\src\constraint
 */
class ContactValidation extends Validation
{
    /**
     * @var array
     */
    private $errors = [];
    /**
     * @var Constraint
     */
    private $constraint;

    /**
     * UserValidation constructor.
     */
    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    /**
     * Check data and return errors array
     * @param Parameter $post
     * @return array
     */
    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value)
        {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    /**
     * According to $name and $value, call a specific function to check if data verify constraints
     * If not, fill errors array
     * @param $name
     * @param $value
     */
    private function checkField($name, $value)
    {
        if($name === 'lastName')
        {
            $error = $this->checkLastName($value);
            $this->addError($name, $error);
        }
        elseif ($name === 'firstName')
        {
            $error = $this->checkFirstName($value);
            $this->addError($name, $error);
        }
        elseif ($name === 'mail')
        {
            $error = $this->checkMail($value);
            $this->addError($name, $error);
        }
        elseif ($name === 'message')
        {
            $error = $this->checkMessage($value);
            $this->addError($name, $error);
        }
    }

    /**
     * Fill errors array
     * @param $name
     * @param $error
     */
    private function addError($name, $error)
    {
        if($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }

    /**
     * Check lastName field
     * @param $value
     * @return string
     */
    private function checkLastName($value)
    {
        if($this->constraint->notBlank($value))
        {
            return $this->constraint->notBlank($value);
        }
        if($this->constraint->minLength($value, 2))
        {
            return $this->constraint->minLength($value, 2);
        }
        if($this->constraint->maxLength($value, 255))
        {
            return $this->constraint->maxLength($value, 255);
        }
    }

    /**
     * Check firstName field
     * @param $value
     * @return string
     */
    private function checkFirstName($value)
    {
        if($this->constraint->notBlank($value))
        {
            return $this->constraint->notBlank($value);
        }
        if($this->constraint->minLength($value, 2))
        {
            return $this->constraint->minLength($value, 2);
        }
        if($this->constraint->maxLength($value, 255))
        {
            return $this->constraint->maxLength($value, 255);
        }
    }

    /**
     * Check mail field
     * @param $value
     * @return string
     */
    private function checkMail($value)
    {
        if($this->constraint->notBlank($value))
        {
            return $this->constraint->notBlank($value);
        }

        if($this->constraint->isEmail($value))
        {
            return $this->constraint->isEmail($value);
        }
    }

    /**
     * Check message field
     * @param $value
     * @return string
     */
    private function checkMessage($value)
    {
        if($this->constraint->notBlank($value))
        {
            return $this->constraint->notBlank($value);
        }
    }
}