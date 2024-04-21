<?php

namespace Core\LmsLite\DataObjects;

use App\Models\Course;
use Carbon\CarbonImmutable;
use Core\LmsLite\Enums\CourseStatus;
use Illuminate\Contracts\Pagination\CursorPaginator as CursorPaginatorContract;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class CourseData extends Data
{
    public function __construct(
        public int      $id, // primary key
        public string   $title,
        public string   $slug, // unique
        public CarbonImmutable   $date,
        public ?string  $description,
        public ?string  $content,
        public ?string  $imageUrl,
        public ?string  $level,
        public ?CategoryData  $category,
        public ?TeacherData $teacher,
        public CourseStatus $status = CourseStatus::DRAFT,
        // metadata
        public array $meta = [],
    )
    {}

    public static function fromArray(array $input): self
    {
        return new self(
            id: $input['id'] ?? 0,
            title: $input['title'],
            slug: $input['slug'],
            date: CarbonImmutable::parse($input['date'])->toImmutable(),
            description: $input['description'] ?? null,
            content: $input['content'] ?? null,
            imageUrl: $input['imageUrl'] ?? null,
            level: $input['level'] ?? null,
            category: CategoryData::fromArray($input['category']),
            teacher: TeacherData::fromArray($input['teacher']),
            status: CourseStatus::from($input['status']),
        );
    }

    public static function fromModel(Course $course): self
    {
        return new self(
            id: $course->id,
            title: $course->title,
            slug: $course->slug,
            date: $course->date->toImmutable(),
            description: $course->description,
            content: $course->content,
            imageUrl: $course->imageUrl,
            level: $course->level,
            category: CategoryData::fromModel($course->category),
            teacher: TeacherData::fromModel($course->teacher),
            status: $course->status,
        );
    }

    public static function collect(mixed $items, ?string $into = null): PaginatorContract|Enumerable|array|Collection|PaginatedDataCollection|DataCollection|AbstractCursorPaginator|CursorPaginatedDataCollection|LazyCollection|AbstractPaginator|CursorPaginatorContract
    {
        return collect($items)
            ->map(fn($item) => self::from($item));
    }
}
