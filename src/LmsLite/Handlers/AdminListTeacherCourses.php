<?php

namespace Core\LmsLite\Handlers;

use App\Models\Course;
use App\Models\Teacher;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\Repositories\TeacherRepository;
use Core\LmsLite\View\Cells\TableCell;
use Core\LmsLite\View\CourseTableTest;
use Core\LmsLite\View\Menu\Menu;
use Core\LmsLite\View\Menu\MenuItemLink;
use Illuminate\Http\Request;

class AdminListTeacherCourses
{

    public function __invoke(TeacherRepository $repository, Request $request, Teacher $teacher): array
    {
        // features: filter, sort, pagination, search. implement each feature in a pipe like methods
        // filter: filter by status, sort: sort by name, pagination: 10 items per page, search: search by name

        // filter
        $courses = $repository->getTeacherCourses($teacher, $request);

        return [
            'courses' => $courses,
        ];
    }

    public function getAllCourses(Request $request)
    {
        $table = CourseTableTest::init(
            CourseData::collect(
                Course::all()
            )
        )->addColumn('title', 'Course', function ($name, $model): TableCell {
            return TableCell::Avatar($model->title, $model->teacher->fullName, $model->imageUrl);
        })->addColumn('date', 'Date', function ($name, $model): TableCell {
            return TableCell::Date($model->date->format('Y-m-d'));
        })->addColumn('category', 'Level', function ($name, $model): TableCell {
            return TableCell::Default($model->category->name);
        })->addColumn('status', 'Status', function ($name, $model): TableCell {
            return TableCell::Badge($model->status->value);
        })->addColumn('actions', 'Actions', function ($name, $model, $actions): TableCell {
            $menu = new Menu();
            foreach ($actions as $action => $route) {
                $item = new MenuItemLink(ucfirst($action), $route['href']);
                $item->setColor($route['color']);
                $menu->addItem($item);
            }
            return TableCell::Default($menu->render(), 'whitespace-nowrap px-3 py-5 text-sm text-gray-500');
        });
        return view('admin.courses.index', [
            'table' => $table,
        ]);
    }

}
