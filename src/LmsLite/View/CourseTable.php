<?php

namespace Core\LmsLite\View;

use Carbon\Callback;
use Closure;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\Enums\CourseStatus;
use Core\LmsLite\View\Cells\TableCell;
use Core\LmsLite\View\Menu\Menu;
use Core\LmsLite\View\Menu\MenuItemLink;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Throwable;

class CourseTable
{

    protected array $columns = [
        'title' => 'Title',
        'date' => 'Date',
        'description' => 'Description',
        'image_url' => 'Image',
        'category' => 'Category',
        'teacher' => 'Teacher',
    ];

    protected array $actions = [
        'view' => [
            'value' => 'View',
            'href' => 'view/%s',
            'class' => 'text-indigo-600 hover:text-indigo-900',
        ],
        'edit' => [
            'value' => 'Edit',
            'href' => 'edit/%s',
            'class' => 'text-teal-600 hover:text-teal-900',
        ],
        'delete' => [
            'value' => 'Delete',
            'href' => 'delete/%s',
            'class' => 'text-red-600 hover:text-red-900',
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
     * @param Array<CourseData> $courses
     * @throws Throwable
     */
    public function __construct(
        public array $courses,
    )
    {
        $this->columns = [
            'title' => [
                'header' => 'Title',
                'type' => 'Avatar',
                'data' => [
                    'text' => 'title',
                    'sub_text' => 'title',
                    'image' => 'imageUrl',
                ],
            ],
            'date' => [
                'header' => 'Date',
                'type' => 'Date',
                'data' => [
                    'value' => 'date',
                ],
            ],
            'description' => [
                'header' => 'Description',
                'type' => 'Default',
                'data' => [
                    'value' => 'description',
                    'class' => 'line-clamp-2 px-3 py-5 text-sm text-gray-500',
                ],
            ],
            'status' => [
                'header' => 'Status',
                'type' => 'Badge',
                'data' => [
                    'value' => 'status',
                    'color' => 'green',
                ],
            ],
        ];

        $this->actions = [
            'view' => [
                'value' => 'View',
                'href' => 'view/%s',
                'class' => null,
                'color' => 'indigo',
            ],
            'edit' => [
                'value' => 'Edit',
                'href' => 'edit/%s',
                'class' => null,
                'color' => 'teal',
            ],
            'delete' => [
                'value' => 'Delete',
                'href' => 'delete/%s',
                'class' => null,
                'color' => 'red',
            ],
        ];
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
     * @param $key
     * @param $model
     * @param $data
     * @param $type
     * @return string
     * @throws Throwable
     */
    public function renderCell($key, $data, $type, $model): string
    {
        $input = [];
        try {
            /** @var 'Avatar'|'Date'|'Header'|'Default'|'Link'|'Badge'|'Raw' $type */
            $value = $data['value'] ?? $key;
            $input = match ($type) {
                'Avatar' => [
                    ...$data,
                    'text' => $model->title,
                    'sub_text' => $model->title,
                    'image' => $model->imageUrl,
                ],
                'Link' => [
                    ...$data,
                    'href' => sprintf($data['href'], $model->id),
                    'value' => $data['value'],
                    'color' => $data['color'],
                ],
                'Badge' => [
                    ...$data
                ],
                'Date' => [
                    ...$data,
                    'value' => $model->$value?->format('Y-m-d') ?? 'N/A',
                ],
                'Default' => [
                    ...$data,
                    'value' => $model->$value,
                ],
                'Raw' => $data,
            };

        } catch (Throwable $e) {
            dd($key, $data, $type, $model, $input, $e);
        }

        if ($key === 'status') {
            $input = [
                'value' => $model->status->value,
                'color' => 'green',

            ];
        }

        return TableCell::$type(...$input)->render();
    }

    /**
     * @throws Throwable
     */
    public function renderHeaderCell($value, $class): string
    {
        $data = [
            'value' => $value,
            'class' => $class,
        ];
        return TableCell::Header(...$data)->render();
    }

    /**
     * @throws Throwable
     */
    public function render(): string
    {
        return view('lms::table', [
            'title' => 'Courses',
            'description' => 'List of courses',
            'button' => 'Add course',
            'table' => $this->renderHeader() . $this->renderBody(),
        ])->render();
    }

    public function renderTable(): string
    {
        try {
            $table = [];
            $loop = 0;
            foreach ($this->table as $row) {
                if (empty($row) || !is_array($row) || count($row) === 0)
                {
                    continue;
                }
                $r = Arr::map($row, fn($cell) => $cell = $cell->render());
                if ($loop === 0)
                {
                    $table[] = view('lms::table-header', [
                        'row' => Arr::join($r, "\n"),
                    ])->render();
                }else {
                    $table[] = view('lms::table-row', [
                        'row' => Arr::join($r, "\n"),
                    ])->render();
                }

                $loop++;
            }

            return view('lms::table', [
                'title' => 'Courses',
                'description' => 'List of courses',
                'button' => 'Add course',
                'table' => Arr::join($table, "\n"),
            ])->render();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return '';
        }
    }

    /**
     * @param string $name
     * @param $model
     * @param Closure $callback
     * @return void
     */
    public function addColumn(string $name, $model, Closure $callback): void
    {
        $this->columns[$name] = $callback($model);
    }

    /**
     * @throws Throwable
     */
    public function renderHeader(): string
    {
        $header = [];
        foreach ($this->columns as $value) {
            $header[] = $this->renderHeaderCell($value['header'], null);
        }
        $header[] = $this->renderHeaderCell('actions', null);

        return view('lms::table-header', [
            'row' => Arr::join($header, "\n"),
        ]);
    }

    /**
     * @throws Throwable
     */
    public function renderBody($data = []): string
    {
        $rows = [];
        foreach ($this->courses as $course) {
            $rows[] = $this->renderRow($course);
        }
        return view('lms::table-body', [
            'body' => Arr::join($rows, "\n"),
        ])->render();
    }

    /**
     * @throws Throwable
     */
    public function renderRow($course): string
    {
        $cells = [];
        foreach ($this->columns as $key => $value) {
            $cells[] = $this->renderCell(
                key: $key,
                data: $value['data'],
                type: $value['type'],
                model: $course
            );
        }
        $cells[] = $this->renderActions($course);

        return view('lms::table-row', [
            'row' => Arr::join($cells, "\n"),
        ])->render();
    }

    /**
     * @throws Throwable
     */
    private function renderActions($course): string
    {
        /*$actionCells = [];
        foreach ($this->actions as $key => $value) {
            $actionCells[] = TableCell::Link(
                value: $value['value'],
                href: sprintf($value['href'], $course->id),
                color: $value['color'],
                class: $value['class'],
            )->render();
        }

        return $this->renderCell('actions', [
            'value' => Arr::join($actionCells, "\n"),
            'class' => null,
        ], 'Raw', null);*/
        $menu = $this->createActionsMenu();
        return $this->renderCell('actions', [
            'value' => $menu->render(),
            'class' => null,
        ], 'Raw', null);
    }
}
