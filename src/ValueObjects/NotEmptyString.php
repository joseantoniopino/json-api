<?php


namespace Src\ValueObjects;


use Src\Exceptions\StringIncorrectException;

class NotEmptyString
{
    private string $string;

    public function __construct(string $string)
    {
        if (is_string($string) && !empty($string)){
            $this->setString($string);
        } else {
            throw new StringIncorrectException(sprintf('%s cannot be empty and must be of type string.', $string));
        }
    }

    private function setString(string $string): void
    {
        $this->string = $string;
    }

    public function __toString(): string
    {
        return $this->string;
    }
}
