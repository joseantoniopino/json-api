<?php

namespace Src\Exceptions;

use Throwable;

class StringIncorrectException extends \DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
