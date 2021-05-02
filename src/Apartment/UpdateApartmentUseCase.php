<?php


namespace Src\Apartment;


use Src\Apartment\Exceptions\ApartmentNotFoundException;
use Src\Apartment\Repositories\ApartmentRepositoryInterface;
use Src\ValueObjects\Uuid;

class UpdateApartmentUseCase
{
    public function __construct(private ApartmentRepositoryInterface $repository){}

    public function execute($params)
    {
        $objectId = new Uuid($params['id']);
        $apartmentModel = $this->repository->find($objectId);

        if (!is_null($apartmentModel)){
            $apartment = new ApartmentDomain();
            if (isset($params['category_id']))
                $apartment->setCategoryId($params['category_id']);

            if (isset($params['name']))
                $apartment->setName($params['name']);

            if (isset($params['description']))
                $apartment->setDescription($params['description']);

            if (isset($params['quantity']))
                $apartment->setQuantity($params['quantity']);

            $this->repository->update($apartment->getAttributes(), $objectId);
        } else {
            throw new ApartmentNotFoundException("The apartment with id $objectId has not been found.");
        }


    }
}
