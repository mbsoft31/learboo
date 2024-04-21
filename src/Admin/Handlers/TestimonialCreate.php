<?php

namespace Core\Admin\Handlers;

use Core\Admin\DataObjects\TestimonialData;
use Core\Admin\Repositories\Testimonial\TestimonialRepositoryContract;
use Core\Admin\Requests\TestimonialCreateRequest;
use Illuminate\Http\RedirectResponse;

class TestimonialCreate
{
    public function __invoke(TestimonialRepositoryContract $repository, TestimonialCreateRequest $request): RedirectResponse
    {
        $data = TestimonialData::fromRequest($request);

        if ($data->id === 0) {
            $testimonial = $repository->create($data->except('id')->toArray());
            if (!$testimonial) {
                return $this->createRedirectResponse('danger', 'Failed to create testimonial');
            }
        } else {
            $updated = $repository->update($data->toArray(), $data->id);
            if (!$updated) {
                return $this->createRedirectResponse('danger', 'Failed to update testimonial');
            }
        }

        return $this->createRedirectResponse('success', 'Testimonial saved successfully');
    }

    private function createRedirectResponse(string $type, string $message): RedirectResponse
    {
        return redirect()->route('admin.testimonials')
            ->with('type', $type)
            ->with('message', $message);
    }
}
