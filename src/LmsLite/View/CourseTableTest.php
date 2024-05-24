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
    protected array $filters = [];
    protected array $sort = [];
    protected array $pagination = [];
    protected array $status = [];
    private array $table = [];

    public function __construct(
        public array|Collection $courses
    ){}

    public static function init(array|Collection $courses): CourseTableTest
    {
        return new self($courses);
    }

    public function addColumn(string $name, string $header, Closure $closure): CourseTableTest
    {
        $this->columns[$name] = compact('header', 'closure');
        return $this;
    }

    public function addAction(string $key, string $value, string $href, string $class, string $color): CourseTableTest
    {
        $this->actions[$key] = compact('value', 'href', 'class', 'color');
        return $this;
    }

    public function addFilter(string $key, string $label): CourseTableTest
    {
        $this->filters[$key] = $label;
        return $this;
    }

    public function addSort(string $key, string $label): CourseTableTest
    {
        $this->sort[$key] = $label;
        return $this;
    }

    public function addPagination(int $value): CourseTableTest
    {
        $this->pagination[$value] = $value;
        return $this;
    }

    public function addStatus(string $key, string $label): CourseTableTest
    {
        $this->status[$key] = $label;
        return $this;
    }

    public function createActionsMenu(): Menu
    {
        $menu = new Menu();
        foreach ($this->actions as $key => $action) {
            $item = new MenuItemLink($key, $action['value'], $action['href']);
            $item->setColor($action['color']);
            $menu = $menu->addItem($item);
        }
        return $menu;
    }

    /**
     * @throws Throwable
     */
    public function render(): string
    {
        $head = $this->renderHeader();
        $body = $this->renderBody();
        return view('lms::table', [
            'title' => 'Courses',
            'description' => 'List of courses',
            'button' => 'Add course',
            'table' => $head . $body,
        ])->render();
    }

    /**
     * @throws Throwable
     */
    protected function renderHeader(): string
    {
        $header = [];
        foreach ($this->columns as $column) {
            $header[] = TableCell::Header($column['header'])->render();
        }
        return view('lms::table-header', ['row' => Arr::join($header, "\n")])->render();
    }

    /**
     * @throws Throwable
     */
    protected function renderBody(): string
    {
        $body = [];
        foreach ($this->courses as $course) {
            $row = [];
            foreach ($this->columns as $name => $column) {
                $cell = $column['closure']($name, $course, $this->actions);
                $row[$name] = $cell->render();
            }
            $body[] = Arr::join($row, "\n");
        }
        return view('lms::table-body', [
            'body' => Arr::join(Arr::map($body, function ($row) {
                return view('lms::table-row', ['row' => $row])->render();
            }), "\n")
        ])->render();
    }
}
