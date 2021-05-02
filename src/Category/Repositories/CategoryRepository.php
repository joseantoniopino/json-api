<?php


namespace Src\Category\Repositories;


use App\Models\Apartment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository implements CategoryRepositoryInterface
{

    protected Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }


    public function all()
    {
        return $this->model->with('apartments')->applyFilters()->applySorts()->jsonPaginate();
    }

    public function create(array $data): void
    {
        $this->model->create($data);
    }

    public function update(array $data, string $id): void
    {
        $this->model->where('id', $id)->update($data);
    }

    public function delete(string $id): void
    {
        $this->model->destroy($id);
    }

    public function find(string $id): Builder|array|Collection|Model
    {
        if (null == $category = $this->model->with('apartments:id,name')->find($id)) {
            throw new ModelNotFoundException("Category not found");
        }
        return $category;
    }
}
