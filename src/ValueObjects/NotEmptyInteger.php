<?php


namespace Src\ValueObjects;


use Src\Exceptions\IncorrectNumberFormatException;

class NotEmptyInteger
{
    private string $number;
    public function __construct(string $number)
    {
        if (!is_null($number) && is_numeric($number)){
            $this->setNumber($number);
        } else {
            throw new IncorrectNumberFormatException('The value must be an integer.');
        }
    }

    private function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function __toString(): string
    {
        return $this->number;
    }
}
