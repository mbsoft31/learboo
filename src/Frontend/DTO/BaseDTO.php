<?php

namespace Core\Frontend\DTO;

use Illuminate\Contracts\Support\Arrayable;

readonly abstract class BaseDTO implements \JsonSerializable, Arrayable
{
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

}
