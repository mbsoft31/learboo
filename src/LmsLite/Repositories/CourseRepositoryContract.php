<?php

namespace Core\LmsLite\Repositories;

use App\Models\Course;
use Core\LmsLite\DataObjects\CourseData;

interface CourseRepositoryContract
{

    public function createCourse(CourseData $courseData): CourseData;

    public function updateCourse(Course $course, CourseData $courseData): CourseData;

    public function getCourse(int $courseId): CourseData;

    public function getCourses(array $filters = [], array $sort = [], array $fields = []): array;

}
