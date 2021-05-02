<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentCollection;
use App\Http\Resources\ApartmentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use Src\Apartment\Infrastructure\Repositories\ApartmentRepositoryInterface;
use Src\Apartment\Application\SaveApartmentUseCase;
use Src\Apartment\Application\UpdateApartmentUseCase;

class ApartmentController extends Controller
{

    public function __construct(private ApartmentRepositoryInterface $repository){}


    // RESOURCE
    public function index(): ApartmentCollection
    {
        $apartments = $this->repository->all();
        return ApartmentCollection::make($apartments);
    }


    public function store(Request $request): JsonResponse
    {
        (new SaveApartmentUseCase($this->repository))->execute($request->all());

        $data = $this->createResponse(200, 'Apartment created', $request->get('id'));
        return new JsonResponse($data, 200);
    }


    // RESOURCE
    public function show(string $id): ApartmentResource
    {
        $apartment = $this->repository->find($id);
        return ApartmentResource::make($apartment);
    }


    public function update(Request $request, string $id): JsonResponse
    {
        $request->request->add(['id' => $id]);
        (new UpdateApartmentUseCase($this->repository))->execute($request->all());
        $data = $this->createResponse(201, 'Apartment updated', $id);
        return new JsonResponse($data, 201);
    }


    public function destroy(string $id): JsonResponse
    {
        $this->repository->delete($id);
        $data = $this->createResponse(201, 'Apartment deleted', $id);
        return new JsonResponse($data, $data['status']);
    }


    #[ArrayShape(['status' => "string", 'message' => "string", 'id' => "string"])]
    private function createResponse(int $status, string $message, string $id): array
    {
        return [
          'status' => $status,
          'message' => $message,
          'id' => $id
        ];
    }
}
