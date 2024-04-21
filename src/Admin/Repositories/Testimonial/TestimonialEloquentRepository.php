<?php

namespace Core\Admin\Repositories\Testimonial;

use App\Models\Testimonial;
use Core\Admin\DataObjects\TestimonialData;
use Illuminate\Pagination\LengthAwarePaginator;

class TestimonialEloquentRepository implements TestimonialRepositoryContract
{
    protected string $model;

    public function __construct(string $model)
    {
        $this->model = $model;
    }

    public function all(): array
    {
        return $this->model::all()->toArray();
    }

    public function find(mixed $id): ?object
    {
        return $this->model::find($id);
    }

    public function create(mixed $data): ?object
    {
        return $this->model::create($data);
    }

    public function update(mixed $data, mixed $id): bool
    {
        $modelInstance = $this->model::find($id);
        return $modelInstance ? $modelInstance->update($data) : false;
    }

    public function delete($id): bool
    {
        $modelInstance = $this->model::find($id);
        return $modelInstance ? $modelInstance->delete() : false;
    }

    public function paginate(mixed $perPage): mixed
    {
        return TestimonialData::collect($this->model::paginate($perPage));
    }
}
