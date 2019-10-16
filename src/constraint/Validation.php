<?php

namespace App\src\constraint;

/**
 * Class Validation
 * @package App\src\constraint
 */
class Validation
{
    /**
     * Validate sent data for article, comment or user submission
     * @param $data
     * @param $name
     * @return array
     */
    public function validate($data, $name)
    {
        if($name === 'Article') {
            $articleValidation = new ArticleValidation();
            $errors = $articleValidation->check($data);
            return $errors;
        } elseif ($name === 'Comment') {
            $commentValidation = new CommentValidation();
            $errors = $commentValidation->check($data);
            return $errors;
        } elseif ($name === 'User') {
            $userValidation = new UserValidation();
            $errors = $userValidation->check($data);
            return $errors;
        }
    }
}