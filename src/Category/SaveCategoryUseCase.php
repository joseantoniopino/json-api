<?php


namespace Src\Category;




use Src\Category\Repositories\CategoryRepositoryInterface;

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
