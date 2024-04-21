<?php

namespace Core\Admin\DataObjects;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

class TestimonialData extends Data
{

    public function __construct(
        public int     $id,
        public string  $name,
        public string  $email,
        public ?string $position,
        public ?string $company,
        public string  $testimonial,
        public ?string $imageUrl,
    ) {}

    public static function fromArray(array $array): self
    {
        return new self(
            id: $array['id'] ?? 0,
            name: $array['name'],
            email: $array['email'],
            position: $array['position'],
            company: $array['company'],
            testimonial: $array['testimonial'],
            imageUrl: $array['imageUrl'],
        );
    }

    public static function fromModel(Testimonial $testimonial): self
    {
        return new self(
            id: $testimonial->id,
            name: $testimonial->name,
            email: $testimonial->email,
            position: $testimonial->position,
            company: $testimonial->company,
            testimonial: $testimonial->testimonial,
            imageUrl: $testimonial->imageUrl,
        );
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: $request->id,
            name: $request->name,
            email: $request->email,
            position: $request->position,
            company: $request->company,
            testimonial: $request->testimonial,
            imageUrl: $request->image,
        );
    }

    public static function loadFromFile(string $file): array
    {
        $data = require $file;
        return array_map(fn($item) => self::fromArray($item), $data);
    }

    public static function toPhpArrayString(array $data): string
    {
        return Str::of(json_encode($data, JSON_PRETTY_PRINT))
            ->replace('{', '[')
            ->replace('}', ']')
            ->replace(': ', ' => ')
            ->__toString();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'position' => $this->position,
            'company' => $this->company,
            'testimonial' => $this->testimonial,
            'imageUrl' => $this->imageUrl,
        ];
    }

    public static function saveToFile(array $testimonials): int|false
    {
        return file_put_contents(
            resource_path('data/testimonials.php'),
            sprintf("<?php\n\nreturn %s;", TestimonialData::toPhpArrayString($testimonials))
        );
    }

}
