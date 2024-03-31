<?php

namespace Core\Frontend\DTO;

use Core\Frontend\DTO\BaseDTO;

readonly class Course extends BaseDTO
{

    public function __construct(
        public ?string  $title,
        public ?string  $description,
        public ?string  $imageUrl,
        public ?string  $date,
        public ?string  $category,
        public ?Teacher $teacher,
    )
    {}

    public static function fromArray(array $input): self
    {
        return new self(
            title: $input['title'],
            description: $input['description'],
            imageUrl: $input['imageUrl'],
            date: $input['date'],
            category: $input['category'],
            teacher: Teacher::fromArray($input['teacher']),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'imageUrl' => $this->imageUrl,
            'date' => $this->date,
            'category' => $this->category,
            'teacher' => $this->teacher,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
