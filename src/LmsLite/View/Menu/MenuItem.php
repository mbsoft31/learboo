<?php

namespace Core\LmsLite\View\Menu;

use Illuminate\Contracts\Support\Renderable;
use InvalidArgumentException;

abstract class MenuItem implements Renderable
{
    protected array $colors = [
        'gray' => 'text-gray-700 hover:bg-gray-100',
        'red' => 'text-red-700 hover:bg-red-100',
        'yellow' => 'text-yellow-700 hover:bg-yellow-100',
        'green' => 'text-green-700 hover:bg-green-100',
        'blue' => 'text-blue-700 hover:bg-blue-100',
        'indigo' => 'text-indigo-700 hover:bg-indigo-100',
        'purple' => 'text-purple-700 hover:bg-purple-100',
        'pink' => 'text-pink-700 hover:bg-pink-100',
        'teal' => 'text-teal-700 hover:bg-teal-100',
    ];

    protected string $view = '';
    protected string $color = 'gray';

    /**
     * @param string $color
     * @return $this
     */
    public function setColor(string $color): MenuItem
    {
        if (!array_key_exists($color, $this->colors)) {
            throw new InvalidArgumentException("Color $color is not supported");
        }
        $this->color = $color;
        return $this;
    }
}
