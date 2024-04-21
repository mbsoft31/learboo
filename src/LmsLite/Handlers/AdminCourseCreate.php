<?php

namespace Core\LmsLite\Handlers;

use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\Repositories\CourseRepository;
use Core\LmsLite\Requests\CourseCreateRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class AdminCourseCreate
{

    public function __invoke(CourseRepository $repository, CourseCreateRequest $request): JsonResponse
    {
        $data = CourseData::fromArray($request->validated());

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

}
