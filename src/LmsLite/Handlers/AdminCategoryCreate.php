<?php

namespace Core\LmsLite\Handlers;

use Core\LmsLite\DataObjects\CategoryData;
use Core\LmsLite\Repositories\CourseRepository;
use Core\LmsLite\Requests\CategoryCreateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class AdminCategoryCreate
{
    public function __invoke(CourseRepository $repository, CategoryCreateRequest $request): JsonResponse
    {
        $request->merge([
            'slug' => $request->has('slug') ? $request->get('slug') :
                Str::slug($request->get('name')),
        ]);

        try {
            $category = $repository->createCategory(CategoryData::fromRequest($request));
            return response()->json(
                data: ['category' => $category->toArray()],
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
