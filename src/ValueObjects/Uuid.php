<?php


namespace Src\ValueObjects;


use Src\Exceptions\UuidIsInvalidException;

class Uuid
{

    private string $id;

    public function __construct(string $id)
    {
        if ($this->isValidUuid($id)){
            $this->setId($id);
        } else {
            throw new UuidIsInvalidException(sprintf("The id: '%s' does not meet uuid V4 specifications.", $id));
        }
    }

    private function isValidUuid(string $uuid): bool
    {
        if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
            return false;
        }
        return true;
    }

    private function setId(string $id): void
    {
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
