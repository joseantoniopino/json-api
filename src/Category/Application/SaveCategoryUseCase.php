<?php


namespace Src\Category\Application;

use Src\Category\Infrastructure\Repositories\CategoryRepositoryInterface;
use Src\Category\Domain\Entities\CategoryDomain;

class SaveCategoryUseCase
{
    public function __construct(private CategoryRepositoryInterface $repository){}

    public function execute($params)
    {
        $category = new CategoryDomain();
        $category->setId($params['id']);
        $category->setTitle($params['title']);
        $category->setDescription($params['description']);

        $this->repository->create($category->getAttributes());
    }
}
