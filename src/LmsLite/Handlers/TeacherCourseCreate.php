<?php

namespace Core\LmsLite\Handlers;

use App\Models\Category;
use App\Models\Teacher;
use Core\LmsLite\DataObjects\CategoryData;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\DataObjects\TeacherData;
use Core\LmsLite\Repositories\CourseRepository;
use Core\LmsLite\Requests\CourseCreateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherCourseCreate
{
    public function __invoke(CourseRepository $repository, CourseCreateRequest $request): JsonResponse
    {

        $data = CourseData::fromArray($request->validated());
        dd($request->all(), $data);
        try {
            $course = $repository->createCourse($data);
            return response()->json(
                data: ['course' => $course->toArray()],
                status: 201,
            );
        } catch (Exception $e) {
            return response()->json(
                data: ['error' => $e->getMessage()],
                status: 400,
            );
        }
    }

    public function createPage(Request $request, Teacher $teacher): View
    {
        $categories = CategoryData::collect(Category::all());

        return view('teacher.course.create', [
            'categories' => $categories,
            'teacher' => TeacherData::fromModel($teacher),
        ]);
    }
}
