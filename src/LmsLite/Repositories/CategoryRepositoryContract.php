<?php

namespace Core\LmsLite\Repositories;

use Core\LmsLite\DataObjects\CategoryData;
use Core\LmsLite\DataObjects\CourseData;

interface CategoryRepositoryContract
{

    public function createCategory(CategoryData $categoryData): CategoryData;

    public function updateCategory(CategoryData $categoryData): bool;

    public function getCategory(string $slug): CategoryData|null;

    public function getCategories(array $filters = [], array $sort = [], array $fields = []): array;

    public function deleteCategory(string $slug): bool;

    public function addCategoryToCourse(CourseData $courseData, CategoryData $categoryData): bool;

}
