<?php

namespace Core\LmsLite\View\Cells;

use Illuminate\Contracts\Support\Arrayable;

class AvatarData implements Arrayable
{
    public function __construct(
        public string $text,
        public string $sub_text,
        public string $src,
        public string $alt = '',
    ){}

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'sub_text' => $this->sub_text,
            'src' => $this->src,
            'alt' => $this->alt,
        ];
    }

}
