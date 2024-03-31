<?php

namespace Core\Frontend\DTO;

readonly class Teacher extends BaseDTO
{
    public function __construct(
        public string $name,
        public ?string $role,
        public ?string $imageUrl,
    ){}

    public static function fromArray(array $input): self
    {
        return new self(
            name: $input['name'],
            role: $input['role'] ?? null,
            imageUrl: $input['imageUrl'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
            'imageUrl' => $this->imageUrl,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
