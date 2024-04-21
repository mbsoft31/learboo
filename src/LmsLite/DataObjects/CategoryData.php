<?php

namespace Core\LmsLite\DataObjects;

use App\Models\Category;
use Core\LmsLite\Requests\CategoryCreateRequest;
use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        public string $name,
        public string $slug, // primary key, unique
        public ?string $description,
        public ?string $imageUrl,
        public ?string $parentSlug,
    ){}

    public static function fromArray(array $input): self
    {
        return new self(
            name: $input['name'],
            slug: $input['slug'],
            description: $input['description'] ?? null,
            imageUrl: $input['imageUrl'] ?? null,
            parentSlug: $input['parentSlug'] ?? null,
        );
    }

    public static function fromModel(Category $category): self
    {
        return new self(
            name: $category->name,
            slug: $category->slug,
            description: $category->description,
            imageUrl: $category->imageUrl,
            parentSlug: $category->parent_slug,
        );
    }

    public static function fromRequest(CategoryCreateRequest $request): CategoryData
    {
        return self::fromArray($request->validated());
    }

}
