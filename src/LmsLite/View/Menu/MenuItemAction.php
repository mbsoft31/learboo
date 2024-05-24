<?php

namespace Core\LmsLite\View\Menu;

use Core\LmsLite\Enums\HttpMethod;
use Stringable;
use Throwable;

class MenuItemAction extends MenuItem implements Stringable
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

    public function __toString(): string
    {
        try {
            return $this->render();
        } catch (Throwable $e) {
            return '';
        }
    }
}
