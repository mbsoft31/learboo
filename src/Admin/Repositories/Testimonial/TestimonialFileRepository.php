<?php

namespace Core\Admin\Repositories\Testimonial;

use Core\Admin\DataObjects\TestimonialData;
use Core\Admin\Repositories\Testimonial\TestimonialRepositoryContract;
use Illuminate\Support\Collection;

class TestimonialFileRepository implements TestimonialRepositoryContract
{
    protected string $path;

    public function __construct(string $path = null)
    {
        $this->path = $path ?? config('testimonial.file.path');
    }

    /**
     * @return array|Array<TestimonialData>
     */
    public function all(): array
    {
        return TestimonialData::loadFromFile($this->path);
    }

    public function find(mixed $id): ?TestimonialData
    {
        $testimonials = $this->all();
        return collect($testimonials)->firstWhere('id', $id);
    }

    public function create(mixed $data): ?TestimonialData
    {
        $testimonials = $this->all();
        $data['id'] = collect($testimonials)->max('id') + 1;
        $testimonials[] = $data;
        if (!$this->save($testimonials)) {
            return null;
        }
        return TestimonialData::fromArray($data);
    }

    public function update(mixed $data, mixed $id): ?bool
    {
        $testimonials = $this->all();
        $index = $this->findIndex($testimonials, $id);
        if ($index === false) {
            return null;
        }
        $testimonials[$index] = [...$testimonials[$index]->toArray(), ...$data];
        return $this->save($testimonials);
    }

    public function delete(mixed $id): ?bool
    {
        $testimonials = $this->all();
        $index = $this->findIndex($testimonials, $id);
        if ($index === false) {
            return null;
        }
        unset($testimonials[$index]);
        return $this->save($testimonials);
    }

    public function paginate(mixed $perPage): Collection
    {
        $testimonials = $this->all();
        return collect($testimonials)->take($perPage);
    }

    private function save(array $testimonials): bool
    {
        return TestimonialData::saveToFile($testimonials);
    }

    /**
     * @param array|Array<TestimonialData> $testimonials
     * @param int $id
     * @return int|false
     */
    private function findIndex(array $testimonials, int $id): int|false
    {
        return collect(array_map(fn($i) => $i->toArray(),$testimonials))->search(fn($testimonial) => $testimonial['id'] == $id);
    }
}
