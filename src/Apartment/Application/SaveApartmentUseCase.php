<?php


namespace Src\Apartment\Application;


use Src\Apartment\Domain\Entities\ApartmentDomain;
use Src\Apartment\Infrastructure\Repositories\ApartmentRepositoryInterface;

class SaveApartmentUseCase
{
    public function __construct(private ApartmentRepositoryInterface $repository){}

    public function execute($params)
    {
        $apartment = new ApartmentDomain();
        $apartment->setId($params['id']);
        $apartment->setCategoryId($params['category_id']);
        $apartment->setName($params['name']);
        $apartment->setDescription($params['description']);
        $apartment->setQuantity($params['quantity']);

        $this->repository->create($apartment->getAttributes());
    }
}
