<?php

namespace Core\Frontend\DTO;

readonly class NavigationLink extends BaseDTO
{

    public function __construct(
        public string $name,
        public string $label,
        public string $route,
        public string $icon,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            label: $data['label'],
            route: $data['route'],
            icon: $data['icon'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'route' => $this->route,
            'icon' => $this->icon,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
