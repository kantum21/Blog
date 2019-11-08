<?php

namespace App\src\constraint;
use App\config\Parameter;

/**
 * Class CommentValidation
 * @package App\src\constraint
 */
class CommentValidation extends Validation
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
     * CommentValidation constructor.
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
        if ($name === 'content')
        {
            $error = $this->checkContent($value);
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
        if($error)
        {
            $this->errors += [
                $name => $error
            ];
        }
    }

    /**
     * Check Content field
     * @param $value
     * @return string
     */
    private function checkContent($value)
    {
        if($this->constraint->notBlank($value))
        {
            return $this->constraint->notBlank($value);
        }
        if($this->constraint->minLength($value, 2))
        {
            return $this->constraint->minLength($value, 2);
        }
    }
}