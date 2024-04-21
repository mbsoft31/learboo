<?php

namespace Core\LmsLite\Handlers;

use App\Models\Course;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\Repositories\CourseRepository;
use Core\LmsLite\Requests\CourseCategoryRequest;
use Core\LmsLite\Requests\CourseUpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class AdminCourseUpdate
{
    public function __invoke(CourseRepository $repository, CourseUpdateRequest $request, Course $course): JsonResponse
    {
        $data = CourseData::fromArray($request->validated());

        try {
            $course = $repository->updateCourse($course, $data);
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

    public function updateCourseCategory(CourseRepository $repository, CourseCategoryRequest $request): JsonResponse
    {
        $inputs = $request->validated();
        $courseData = $repository->getCourse($inputs['courseId']);
        $categoryData = $repository->getCategory($inputs['categorySlug']);

        try {
            $updated = $repository->addCategoryToCourse($courseData, $categoryData);
            if ($updated)
            {
                return response()->json(
                    data: ['course' => $courseData->toArray()],
                    status: 201,
                );
            }
            return response()->json(
                data: ['error' => 'Category not added to course'],
                status: 400,
            );
        } catch (Exception $e) {
            return response()->json(
                data: ['error' => $e->getMessage()],
                status: 400,
            );
        }
    }

}
