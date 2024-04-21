<?php

namespace Core\Frontend\DTO;

use Illuminate\Support\Str;

readonly class Navigation extends BaseDTO
{

    /**
     * @param string $name
     * @param array|Array<NavigationLink> $links
     */
    public function __construct(
        public string $name,
        public array $links,
    ){}

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $links = [];
        foreach ($data['links'] as $key => $link) {
            $links[$key] = NavigationLink::fromArray(["name"=>$key, ...$link]);
        }
        return new self(
            name: $data['name'],
            links: $links,
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'links' => $this->links,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param string $file
     * @param string $name
     * @return self
     */
    public static function loadFromFile(string $file, string $name): self
    {
        $data = require $file;
        return self::fromArray([
            'name' => $name,
            'links' => $data[$name],
        ]);
    }

    // to prety string to be stored in a php array return file
    public function toPhpArrayString(): string
    {
        return Str::of(json_encode([$this->toArray()], JSON_PRETTY_PRINT))
            ->replace('{', '[')
            ->replace('}', ']')
            ->replace(': ', ' => ')
            ->__toString();
    }

}
