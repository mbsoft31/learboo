<?php

namespace Core\LmsLite\View\Cells;

use Illuminate\Contracts\Support\Renderable;
use Throwable;

class TableCell implements Renderable
{

    public function __construct(
        protected string $view,
        protected array $data
    ){}

    /**
     * @throws Throwable
     */
    public function render(): string
    {
        return view($this->view, $this->data)->render();
    }

    /**
     * @throws Throwable
     */
    public static function Avatar(string $text, string $sub_text, string $image): TableCell
    {
        return TableCell::Raw(
            (new TableCell('lms::cells.avatar', [
                'text' => $text,
                'sub_text' => $sub_text,
                'src' => $image,
                'alt' => 'Avatar Image',
            ]))->render()
        );
    }

    public static function Header(string $value, string $class = null): TableCell
    {
        return new TableCell('lms::table-header-cell', [
            'value' => $value,
            'class' => $class,
        ]);
    }

    public static function Date(string $value, string $class = null): TableCell
    {
        return new TableCell('lms::table-cell', [
            'value' => $value,
            'class' => $class,
        ]);
    }

    public static function Default(string $value, string $class = null): TableCell
    {
        return new TableCell('lms::table-cell', [
            'value' => $value,
            'class' => $class,
        ]);
    }

    public static function Raw(string $value, string $class = null): TableCell
    {
        return new TableCell('lms::table-cell', [
            'value' => $value,
            'class' => $class,
        ]);
    }

    /**
     * @throws Throwable
     */
    public static function Link(string $value, string $href, string $color = 'gray', string $class = null): TableCell
    {
        return TableCell::Raw(
            (new TableCell('lms::cells.link', [
                'value' => $value,
                'href' => $href,
                'color' => $color,
                'class' => $class,
            ]))->render(),
            $class
        );
    }

    /**
     * @throws Throwable
     */
    public static function Badge(string $value, string $color = 'gray', string $class = null): TableCell
    {
        return TableCell::Raw(
            (new TableCell('lms::cells.badge', [
                'value' => $value,
                'color' => $color,
                'class' => $class,
            ]))->render(),
            $class
        );
    }

}
