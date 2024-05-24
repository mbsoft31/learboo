<?php

namespace Core\LmsLite\View\Menu;

use Illuminate\Contracts\Support\Renderable;
use Stringable;
use Throwable;

class MenuItemLink extends MenuItem implements Stringable
{
    protected string $view = 'lms::menu.item-link';

    public function __construct(
        protected string $text,
        protected string $href = "#",
        protected string $target = '_self',
    ){}

    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function render(): string
    {
        return view($this->view, [
            'text' => $this->text,
            'href' => $this->href,
            'target' => $this->target,
        ])->with([
            'colors' => $this->colors,
            'color' => $this->color,
        ])->render();
    }

    public function __toString(): string
    {
        try {
            return $this->render();
        } catch (Throwable $e) {
            return '';
        }
    }
}
