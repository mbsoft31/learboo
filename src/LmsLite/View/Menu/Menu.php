<?php

namespace Core\LmsLite\View\Menu;

use Core\LmsLite\Enums\HttpMethod;
use Illuminate\Contracts\Support\Renderable;
use Throwable;

class Menu implements Renderable
{

    protected string $view = 'lms::cells.menu';
    /**
     * @var Array<MenuItem> $items
     */
    protected array $items = [];

    public function __construct(
        protected string $button = ''
    ){}

    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function render(): string
    {
        return view($this->view, [
            'items' => $this->items,
            'button' => $this->button,
        ])->render();
    }


    public function setButton(string $button): Menu
    {
        $this->button = $button;
        return $this;
    }

    public function addItem(MenuItem $item): Menu
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param Array<MenuItem> $items
     * @return $this
     */
    public function addItems(array $items): Menu
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }

}
