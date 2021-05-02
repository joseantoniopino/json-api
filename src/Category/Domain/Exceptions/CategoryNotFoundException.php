<?php

namespace Src\Category\Domain\Entities\Domain\Exceptions;

use Throwable;

class CategoryNotFoundException extends \DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
