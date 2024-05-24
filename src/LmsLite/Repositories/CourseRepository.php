<?php

namespace Core\LmsLite\Repositories;

use App\Models\Category;
use App\Models\Course;
use Core\LmsLite\DataObjects\CategoryData;
use Core\LmsLite\DataObjects\CourseData;
use Exception;
use Spatie\QueryBuilder\QueryBuilder;

class CourseRepository implements CourseRepositoryContract, CategoryRepositoryContract
{

    /**
     * @throws Exception
     */
    public function createCourse(CourseData $courseData): CourseData
    {
        if (!$courseData->teacher) {
            throw new Exception('Teacher is required');
        }

        if (!$this->getCategory($courseData?->category->slug)) {
            throw new Exception('Category not found');
        }

        $course = Course::updateOrCreate(
            ['slug' => $courseData->slug],
            [
                'title' => $courseData->title,
                'date' => $courseData->date,
                'description' => $courseData->description,
                'image_url' => $courseData->imageUrl,
                'category_slug' => $courseData->category->slug,
                'teacher_id' => $courseData->teacher?->id,
            ]
        );

        return CourseData::fromModel($course);
    }

    /**
     * @throws Exception
     */
    public function updateCourse(Course $course, CourseData $courseData): CourseData
    {
        if (!$courseData->teacher) {
            throw new Exception('Teacher is required');
        }

        $course->update(
            [
                'title' => $courseData->title,
                'date' => $courseData->date,
                'description' => $courseData->description,
                'image_url' => $courseData->imageUrl,
                'category_slug' => $courseData->category,
                'teacher_id' => $courseData->teacher->id,
            ]
        );

        return CourseData::fromModel($course);
    }

    public function getCourse(int $courseId): CourseData
    {
        return CourseData::from(Course::find($courseId));
    }

    public function getCourseBySlug(string $slug): CourseData
    {
        return CourseData::from(Course::firstWhere('slug', $slug));
    }

    public function getCourses(array $filters = [], array $sort = [], array $fields = ['*']): array
    {
        $query = Course::query();

        // Apply filters
        foreach ($filters as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
            }
            else {
                $query->where($field, $value);
            }
        }

        // Apply sorting
        foreach ($sort as $field => $direction) {
            $query->orderBy($field, $direction);
        }

        // Select specific fields
        if (!empty($fields)) {
            $query->select($fields);
        }

        return $query->get()->toArray();
    }

    /**
     * @throws Exception
     */
    public function createCategory(CategoryData $categoryData): CategoryData
    {
        if ($categoryData->parentSlug && !$this->getCategory($categoryData->parentSlug)) {
            throw new Exception('Parent category not found');
        }

        $category = Category::updateOrCreate(
            ['slug' => $categoryData->slug],
            [
                'name' => $categoryData->name,
                'description' => $categoryData->description,
                'imageUrl' => $categoryData->imageUrl,
                'parent_slug' => $categoryData->parentSlug,
            ]
        );

        return new CategoryData(
            name: $category->name,
            slug: $category->slug,
            description: $category->description,
            imageUrl: $category->imageUrl,
            parentSlug: $category->parent_slug,
        );
    }

    /**
     * @throws Exception
     */
    public function updateCategory(CategoryData $categoryData): bool
    {
        if ($categoryData->parentSlug && !$this->getCategory($categoryData->parentSlug)) {
            throw new Exception('Parent category not found');
        }

        return Category::where('slug', $categoryData->slug)->update(
            [
                'name' => $categoryData->name,
                'description' => $categoryData->description,
                'image_url' => $categoryData->imageUrl,
                'parent_slug' => $categoryData->parentSlug,
            ]
        );
    }

    public function getCategory(string $slug): CategoryData|null
    {
        $category = Category::firstWhere('slug', $slug);
        return $category ? CategoryData::fromModel($category) : null;
    }

    public function getCategories(array $filters = [], array $sort = [], array $fields = []): array
    {
        // TODO: Implement getCategories() method.
        return CategoryData::collect(Category::all());
    }

    public function deleteCategory(string $slug): bool
    {
        $category = Category::where('slug', $slug)->first();
        return $category->delete();
    }

    /**
     * @throws Exception
     */
    public function addCategoryToCourse(CourseData $courseData, CategoryData $categoryData): bool
    {
        $course = Course::firstWhere('slug', $courseData->slug);
        $category = Category::firstWhere('slug', $categoryData->slug);

        if (!$course || !$category) {
            throw new Exception('Course or Category not found');
        }

        if ($courseData->category->slug !== $categoryData->slug) {
            $course->category()->associate($category);
        }

        return $course->save();
    }
}
