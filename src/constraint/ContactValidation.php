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
            $error = $this->checkLastName($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'firstName')
        {
            $error = $this->checkFirstName($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'mail')
        {
            $error = $this->checkMail($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'message')
        {
            $error = $this->checkMessage($name, $value);
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
     * @param $name
     * @param $value
     * @return string
     */
    private function checkLastName($name, $value)
    {
        if($this->constraint->notBlank($name, $value))
        {
            return $this->constraint->notBlank('lastName', $value);
        }
        if($this->constraint->minLength($name, $value, 2))
        {
            return $this->constraint->minLength('lastName', $value, 2);
        }
        if($this->constraint->maxLength($name, $value, 255))
        {
            return $this->constraint->maxLength('lastName', $value, 255);
        }
    }

    /**
     * Check firstName field
     * @param $name
     * @param $value
     * @return string
     */
    private function checkFirstName($name, $value)
    {
        if($this->constraint->notBlank($name, $value))
        {
            return $this->constraint->notBlank('firstName', $value);
        }
        if($this->constraint->minLength($name, $value, 2))
        {
            return $this->constraint->minLength('firstName', $value, 2);
        }
        if($this->constraint->maxLength($name, $value, 255))
        {
            return $this->constraint->maxLength('firstName', $value, 255);
        }
    }

    /**
     * Check mail field
     * @param $name
     * @param $value
     * @return string
     */
    private function checkMail($name, $value)
    {
        if($this->constraint->notBlank($name, $value))
        {
            return $this->constraint->notBlank('firstMail', $value);
        }

        if($this->constraint->isEmail($name, $value))
        {
            return $this->constraint->isEmail('firstMail', $value);
        }
    }

    /**
     * Check message field
     * @param $name
     * @param $value
     * @return string
     */
    private function checkMessage($name, $value)
    {
        if($this->constraint->notBlank($name, $value))
        {
            return $this->constraint->notBlank('message', $value);
        }
    }
}