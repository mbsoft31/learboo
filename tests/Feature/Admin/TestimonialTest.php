<?php

use Core\Admin\DataObjects\TestimonialData;
use Core\Admin\Repositories\Testimonial\TestimonialEloquentRepository;
use App\Models\Testimonial;
use Core\Admin\Repositories\Testimonial\TestimonialFileRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

it('returns all testimonials', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);
    Testimonial::factory()->count(5)->create();

    $all = $repository->all();

    expect($all)->toBeArray()->toHaveCount(5);
});

it('finds a testimonial by id', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);
    $testimonial = Testimonial::factory()->create();

    $found = $repository->find($testimonial->id);

    expect($found)->toBeInstanceOf(Testimonial::class)
        ->and($found->id)->toBe($testimonial->id);
});

it('returns null when finding a non-existent testimonial', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);

    $found = $repository->find(999);

    expect($found)->toBeNull();
});

it('creates a new testimonial', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);
    $data = [
        "name" => "Jane Doe",
        "email" => "jane@mail.com",
        "position" => "CTO",
        "company" => "Company Inc.",
        "testimonial" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus eget nunc. Donec nec nunc nec nunc.",
        "imageUrl" => "https://via.placeholder.com/150"
    ];

    $created = $repository->create($data);

    expect($created)->toBeInstanceOf(Testimonial::class)
        ->and($created->name)->toBe($data['name'])
        ->and($created->testimonial)->toBe($data['testimonial']);
});

it('updates an existing testimonial', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);
    $testimonial = Testimonial::factory()->create();
    $data = ['name' => 'Updated Name', 'testimonial' => 'Updated Content'];

    $updated = $repository->update($data, $testimonial->id);

    expect($updated)->toBeTrue()
        ->and($testimonial->fresh()->name)->toBe($data['name'])
        ->and($testimonial->fresh()->testimonial)->toBe($data['testimonial']);
});

it('returns false when updating a non-existent testimonial', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);
    $data = ['name' => 'Updated Name', 'content' => 'Updated Content'];

    $updated = $repository->update($data, 999);

    expect($updated)->toBeFalse();
});

it('deletes an existing testimonial', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);
    $testimonial = Testimonial::factory()->create();

    $deleted = $repository->delete($testimonial->id);

    expect($deleted)->toBeTrue()
        ->and(Testimonial::find($testimonial->id))->toBeNull();
});

it('returns false when deleting a non-existent testimonial', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);

    $deleted = $repository->delete(999);

    expect($deleted)->toBeFalse();
});

it('paginates testimonials', function () {
    $repository = new TestimonialEloquentRepository(Testimonial::class);
    Testimonial::factory()->count(50)->create();

    $paginated = $repository->paginate(10);

    expect($paginated)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($paginated->total())->toBe(50)
        ->and($paginated->perPage())->toBe(10);
});

it('returns all testimonials from file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));

    $all = $repository->all();

    expect($all)->toBeArray();
});

it('finds a testimonial by id from file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));
    $id = 1;

    $found = $repository->find($id);

    expect($found)->toBeInstanceOf(TestimonialData::class)
        ->and($found->id)->toBe($id);
});

it('returns null when finding a non-existent testimonial from file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));

    $found = $repository->find(999);

    expect($found)->toBeNull();
});

it('creates a new testimonial in file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));
    $data = [
        "name" => "Jane Doe",
        "email" => "jane@mail.com",
        "position" => "CTO",
        "company" => "Company Inc.",
        "testimonial" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus eget nunc. Donec nec nunc nec nunc.",
        "imageUrl" => "https://via.placeholder.com/150"
    ];

    $created = $repository->create($data);

    expect($created)->toBeInstanceOf(TestimonialData::class)
        ->and($created->name)->toBe($data['name'])
        ->and($created->testimonial)->toBe($data['testimonial']);
});

it('updates an existing testimonial in file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));
    $id = 3;
    $data = ['name' => 'Updated Name', 'testimonial' => 'Updated Content'];

    $updated = $repository->update($data, $id);

    expect($updated)->toBeTrue();
});

it('returns null when updating a non-existent testimonial in file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));
    $data = ['name' => 'Updated Name', 'testimonial' => 'Updated Content'];

    $updated = $repository->update($data, 999);

    expect($updated)->toBeNull();
});

it('deletes an existing testimonial from file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));
    $data = [
        "name" => "Jane Doe",
        "email" => "jane@mail.com",
        "position" => "CTO",
        "company" => "Company Inc.",
        "testimonial" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus eget nunc. Donec nec nunc nec nunc.",
        "imageUrl" => "https://via.placeholder.com/150"
    ];

    $created = $repository->create($data);
    $id = 2;

    if ($created) {
        $id = $created->id;
    }


    $deleted = $repository->delete($id);

    expect($deleted)->toBeTrue();
});

it('returns null when deleting a non-existent testimonial from file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));

    $deleted = $repository->delete(999);

    expect($deleted)->toBeNull();
});

it('paginates testimonials from file', function () {
    $repository = new TestimonialFileRepository(resource_path('data/testimonials.php'));

    $paginated = $repository->paginate(10);

    expect($paginated)->toBeInstanceOf(Collection::class);
});
