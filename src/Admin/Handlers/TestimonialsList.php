<?php

namespace Core\Admin\Handlers;

use Core\Admin\Repositories\Testimonial\TestimonialRepositoryContract;
use Illuminate\Contracts\View\View;

class TestimonialsList
{
    public function __invoke(TestimonialRepositoryContract $repository): View
    {
        return view('admin.testimonials.index', [
            'testimonials' => $repository->paginate(6),
        ]);
    }
}
