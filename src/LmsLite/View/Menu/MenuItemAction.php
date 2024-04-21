<?php

namespace Core\LmsLite\View\Menu;

use Core\LmsLite\Enums\HttpMethod;
use Throwable;

class MenuItemAction extends MenuItem
{
    protected string $view = 'lms::menu.item-action';
    public function __construct(
        protected string $text,
        protected string $action = "#",
        protected HttpMethod $method = HttpMethod::POST,
    ){}

    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function render(): string
    {
        return view($this->view, [
            'text' => $this->text,
            'action' => $this->action,
            'method' => $this->method,
        ])->with([
            'colors' => $this->colors,
            'color' => $this->color,
        ])->render();
    }

    public function setView(string $view): MenuItemAction
    {
        $this->view = $view;
        return $this;
    }

    public function setText(string $text): MenuItemAction
    {
        $this->text = $text;
        return $this;
    }

    public function setAction(string $action): MenuItemAction
    {
        $this->action = $action;
        return $this;
    }

    public function setMethod(HttpMethod $method): MenuItemAction
    {
        $this->method = $method;
        return $this;
    }

    public static function Get(string $text, string $action = "#"): MenuItemAction
    {
        return new MenuItemAction($text, $action, HttpMethod::GET);
    }

    public static function Post(string $text, string $action = "#"): MenuItemAction
    {
        return new MenuItemAction($text, $action, HttpMethod::POST);
    }

    public static function Delete(string $text, string $action = "#"): MenuItemAction
    {
        return new MenuItemAction($text, $action, HttpMethod::DELETE);
    }
}
