<?php


namespace Src\Apartment\Infrastructure\Repositories;


use App\Models\Apartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApartmentRepository implements ApartmentRepositoryInterface
{

    protected Apartment $model;

    public function __construct(Apartment $apartment)
    {
        $this->model = $apartment;
    }


    public function all()
    {
        return $this->model->with('category')->applyFilters()->applySorts()->jsonPaginate();
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
        if (null == $apartment = $this->model->with('category:id,title')->find($id)) {
            throw new ModelNotFoundException("Apartment not found");
        }
        return $apartment;
    }
}
