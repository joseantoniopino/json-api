<?php

namespace Src\Apartment\Exceptions;

use Throwable;

class ApartmentNotFoundException extends \DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
