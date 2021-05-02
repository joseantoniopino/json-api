<?php


namespace Src\Apartment;


use Src\ValueObjects\NotEmptyInteger;
use Src\ValueObjects\NotEmptyString;
use Src\ValueObjects\Uuid;

class ApartmentDomain
{
    private string $id;
    private string $categoryId;
    private string $name;
    private string $description;
    private string $quantity;

    public function setId(string $id)
    {
        $this->id = new Uuid($id);
    }

    public function setCategoryId(string $categoryId)
    {
        $this->categoryId = new Uuid($categoryId);
    }

    public function setName(string $name)
    {
        $this->name = new NotEmptyString($name);
    }

    public function setDescription(string $description)
    {
        $this->description = new NotEmptyString($description);
    }

    public function setQuantity(string $quantity)
    {
        $this->quantity = new NotEmptyInteger($quantity);
    }


    private function getId(): string
    {
        return $this->id;
    }

    private function getCategoryId(): string
    {
        return $this->categoryId;
    }

    private function getName(): string
    {
        return $this->name;
    }

    private function getDescription(): string
    {
        return $this->description;
    }

    private function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getAttributes(): array
    {
        $data = [];
        if (isset($this->id))
            $data['id'] = $this->getId();

        if (isset($this->categoryId))
            $data['category_id'] = $this->getCategoryId();

        if (isset($this->name))
            $data['name'] = $this->getName();

        if (isset($this->description))
            $data['description'] = $this->getDescription();

        if (isset($this->quantity))
            $data['quantity'] = $this->getQuantity();

        return $data;
    }


}
