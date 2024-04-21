<?php

namespace Core\Admin\Handlers;

use Core\Admin\DataObjects\TestimonialData;
use Core\Admin\Repositories\Testimonial\TestimonialRepositoryContract;
use Core\Admin\Requests\TestimonialUpdateRequest;
use Illuminate\Http\RedirectResponse;

class TestimonialUpdate
{
    public function __invoke(TestimonialRepositoryContract $repository, TestimonialUpdateRequest $request, int $testimonial): RedirectResponse
    {
        $data = TestimonialData::fromRequest($request);
        $testimonial = $repository->find($testimonial);

        if (!$testimonial) {
            return $this->createRedirectResponse('danger', 'Testimonial not found');
        }

        if (!$repository->update($data->toArray(), $testimonial->id)) {
            return $this->createRedirectResponse('danger', 'Failed to update testimonial');
        }

        return $this->createRedirectResponse('success', 'Testimonial updated successfully');
    }

    private function createRedirectResponse(string $type, string $message): RedirectResponse
    {
        return redirect()->back()
            ->with('type', $type)
            ->with('message', $message);
    }
}
