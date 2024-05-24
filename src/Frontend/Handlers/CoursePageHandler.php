<?php

namespace Core\Frontend\Handlers;

use App\Models\Course;
use Illuminate\View\View;

class CoursePageHandler
{
    public function __invoke(string $course): View
    {
        $courses = Course::where("slug", $course)->firstOrFail();
        return view("course-single", [
            "course" => $courses
        ]);
    }
}
