<?php

namespace Core\Frontend\DTO;

use Spatie\LaravelData\Data;

class TestimonialData extends Data
{

    public function __construct(
        public string $name,
        public string $position,
        public string $company,
        public string $testimonial,
        public string $imageUrl,
    ) {
    }

    public static function loadFromFile(string $file): array
    {
        $data = require $file;
        return array_map(fn($item) => self::fromArray($item), $data);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'position' => $this->position,
            'company' => $this->company,
            'testimonial' => $this->testimonial,
            'imageUrl' => $this->imageUrl,
        ];
    }

    public static function fromArray(array $array): self
    {
        return new self(
            name: $array['name'],
            position: $array['position'],
            company: $array['company'],
            testimonial: $array['testimonial'],
            imageUrl: $array['imageUrl'],
        );
    }

}
