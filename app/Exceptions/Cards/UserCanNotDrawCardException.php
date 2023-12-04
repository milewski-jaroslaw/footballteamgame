<?php

namespace App\Exceptions\Cards;

use Exception;

class UserCanNotDrawCardException extends Exception
{
    public function __construct($message = null, $code = 400, Exception $previous = null)
    {
        $message = $message ?: 'The user cannot draw a new card.';
        parent::__construct($message, $code, $previous);
    }
}
