<?php

namespace Core\Frontend\Handlers;

use App\Models\Course;
use App\Models\Faq;
use App\Models\Teacher;
use Core\Admin\Repositories\Testimonial\TestimonialRepositoryContract;
use Core\Frontend\DTO\FaqData;
use Core\Frontend\DTO\Navigation;
use Core\Frontend\DTO\TestimonialData;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\DataObjects\TeacherData;
use Core\LmsLite\Repositories\CourseRepository;
use Illuminate\View\View;

class HomePageHandler
{

    public function __invoke(TestimonialRepositoryContract $repository): View
    {

        return view('welcome', [
            'navigation' => Navigation::loadFromFile(resource_path('data/navigations.php'), 'main'),
            'faqs' => FaqData::collect(Faq::all()),
            'testimonials' => TestimonialData::collect($repository->all()),
            'courses' => CourseData::collect(Course::all()),
            'teachers' => TeacherData::collect(Teacher::all())
        ]);
    }
}
