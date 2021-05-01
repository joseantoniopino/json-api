<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentCollection;
use App\Http\Resources\ApartmentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use Src\Apartment\Repositories\ApartmentRepositoryInterface;

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
        $this->repository->create($request->all());
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
        $this->repository->update($request->all(), $id);
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
