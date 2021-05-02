<?php


namespace Src\Category;

use Src\Category\Exceptions\CategoryNotFoundException;
use Src\Category\Repositories\CategoryRepositoryInterface;
use Src\ValueObjects\Uuid;

class UpdateCategoryUseCase
{
    public function __construct(private CategoryRepositoryInterface $repository){}

    public function execute($params)
    {
        $objectId = new Uuid($params['id']);
        $categoryModel = $this->repository->find($objectId);

        if (!is_null($categoryModel)){
            $category = new CategoryDomain();

            if (isset($params['title']))
                $category->setTitle($params['title']);

            if (isset($params['description']))
                $category->setDescription($params['description']);

            $this->repository->update($category->getAttributes(), $objectId);
        } else {
            throw new CategoryNotFoundException("The category with id $objectId has not been found.");
        }
    }
}
