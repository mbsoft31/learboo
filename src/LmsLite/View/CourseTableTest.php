<?php

namespace Core\LmsLite\View;

use Closure;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\View\Cells\TableCell;
use Core\LmsLite\View\Menu\Menu;
use Core\LmsLite\View\Menu\MenuItemLink;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Throwable;

class CourseTableTest
{

    protected array $columns = [];

    protected array $actions = [
        'view' => [
            'value' => 'View',
            'href' => 'view/%s',
            'class' => 'text-indigo-600 hover:text-indigo-900',
            'color' => 'indigo',
        ],
        'edit' => [
            'value' => 'Edit',
            'href' => 'edit/%s',
            'class' => 'text-teal-600 hover:text-teal-900',
            'color' => 'teal',
        ],
        'delete' => [
            'value' => 'Delete',
            'href' => 'delete/%s',
            'class' => 'text-red-600 hover:text-red-900',
            'color' => 'red',
        ],
    ];

    protected array $filters = [
        'status' => 'Status',
        'search' => 'Search',
    ];

    protected array $sort = [
        'title' => 'Title',
        'date' => 'Date',
        'category' => 'Category',
        'teacher' => 'Teacher',
    ];

    protected array $pagination = [
        10 => 10,
        20 => 20,
        50 => 50,
        100 => 100,
    ];

    protected array $status = [
        'published' => 'Published',
        'draft' => 'Draft',
        'deleted' => 'Deleted',
    ];
    private array $table = [];


    /**
     * @param array|Array<CourseData>|Collection $courses
     */
    public function __construct(
        public array|Collection $courses
    ){}

    public static function init(array|Collection $courses): CourseTableTest
    {
        return new self($courses);
    }

    // add column to table
    public function addColumn(string $name, string $header, Closure $closure): CourseTableTest
    {
        $this->columns[$name] = [
            'header' => $header,
            'cell' => $closure,
        ];
        return $this;
    }

    public function createActionsMenu(): Menu
    {
        /*$menu = (new Menu())->addItem(new MenuItemLink('view', 'View', 'view/%s'))
            ->addItem(new MenuItemLink('edit', 'Edit', 'edit/%s'))
            ->addItem(new MenuItemLink('delete', 'Delete', 'delete/%s'));*/
        $menu = new Menu();
        foreach ($this->actions as $key => $value) {
            $item = new MenuItemLink($key, $value['value'], $value['href']);
            $item->setColor($value['color']);
            $menu = $menu->addItem($item);
        }
        return $menu;
    }

    /**
     * @throws Throwable
     */
    public function render(): string
    {
        /** @var TableCell $this->columns['cell']*/
        $body = [];
        foreach ($this->courses as $course) {
            $row = [];

            foreach ($this->columns as $name => $column) {
                /** @var TableCell $cell*/
                $cell = $column['cell']($name, $course, $this->actions);

                $row[$name] = $cell->render();
            }
            $body[] = $row;
        }

        $head = [];
        foreach ($this->columns as $column) {
            $head[] = TableCell::Header($column['header'])->render();
        }

        $body = view('lms::table-body', [
            'body' => Arr::join(Arr::map($body, function ($row) {
                return view('lms::table-row', ['row' => Arr::join($row, "\n")])->render();
            }), "\n")
        ])->render();
        $head = view('lms::table-header', ['row' => Arr::join($head, "\n")])->render();

        return view('lms::table', [
            'title' => 'Courses',
            'description' => 'List of courses',
            'button' => 'Add course',
            'table' => $head . $body,
        ])->render();
    }

}
