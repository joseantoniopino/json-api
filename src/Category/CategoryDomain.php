<?php


namespace Src\Category;


use Src\ValueObjects\NotEmptyInteger;
use Src\ValueObjects\NotEmptyString;
use Src\ValueObjects\Uuid;

class CategoryDomain
{
    private string $id;
    private string $title;
    private string $description;

    public function setId(string $id)
    {
        $this->id = new Uuid($id);
    }

    public function setTitle(string $title)
    {
        $this->title = new NotEmptyString($title);
    }

    public function setDescription(string $description)
    {
        $this->description = new NotEmptyString($description);
    }


    private function getId(): string
    {
        return $this->id;
    }

    private function getTitle(): string
    {
        return $this->title;
    }

    private function getDescription(): string
    {
        return $this->description;
    }

    public function getAttributes(): array
    {
        $data = [];
        if (isset($this->id))
            $data['id'] = $this->getId();

        if (isset($this->title))
            $data['title'] = $this->getTitle();

        if (isset($this->description))
            $data['description'] = $this->getDescription();

        return $data;
    }


}
