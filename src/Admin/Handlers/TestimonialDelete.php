<?php

namespace Core\Admin\Handlers;

use Core\Admin\Repositories\Testimonial\TestimonialRepositoryContract;
use Illuminate\Http\RedirectResponse;

class TestimonialDelete
{
    public function __invoke(TestimonialRepositoryContract $repository, int $testimonial): RedirectResponse
    {
        $testimonials = $repository->find($testimonial);

        if (!$testimonials) {
            return $this->createRedirectResponse('danger', 'Testimonial not found');
        }

        if (!$repository->delete($testimonial)) {
            return $this->createRedirectResponse('danger', 'Failed to delete testimonial');
        }

        return $this->createRedirectResponse('success', 'Testimonial deleted successfully');
    }

    private function createRedirectResponse(string $type, string $message): RedirectResponse
    {
        return redirect()->route('admin.testimonials')
            ->with('type', $type)
            ->with('message', $message);
    }
}
