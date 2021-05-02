<?php

namespace App\Http\Controllers;

use App\Http\Resources\{CategoryCollection, CategoryResource};
use Illuminate\Http\{JsonResponse, Request};
use JetBrains\PhpStorm\ArrayShape;
use Src\Category\Infrastructure\Repositories\CategoryRepository;
use Src\Category\Application\{SaveCategoryUseCase, UpdateCategoryUseCase};

class CategoryController extends Controller
{

    public function __construct(private CategoryRepository $repository){}


    public function index(): CategoryCollection
    {
        $categories = $this->repository->all();
        return CategoryCollection::make($categories);
    }


    public function store(Request $request): JsonResponse
    {
        (new SaveCategoryUseCase($this->repository))->execute($request->all());

        $data = $this->createResponse(200, 'Category created', $request->get('id'));
        return new JsonResponse($data, 200);
    }


    public function show(string $id): CategoryResource
    {
        $category = $this->repository->find($id);
        return CategoryResource::make($category);
    }


    public function update(Request $request, string $id): JsonResponse
    {
        $request->request->add(['id' => $id]);
        (new UpdateCategoryUseCase($this->repository))->execute($request->all());
        $data = $this->createResponse(201, 'Category updated', $id);
        return new JsonResponse($data, 201);
    }


    public function destroy(string $id): JsonResponse
    {
        $this->repository->delete($id);
        $data = $this->createResponse(201, 'Category deleted', $id);
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
