<?php

namespace Core\Admin\Repositories\Testimonial;

/**
 * Interface TestimonialRepositoryContract
 *
 * This interface defines the contract for a Testimonial Repository.
 * It provides methods for retrieving, creating, updating, deleting, and paginating testimonials.
 */
interface TestimonialRepositoryContract
{
    /**
     * Get all testimonials.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Find a testimonial by its ID.
     *
     * @param mixed $id The ID of the testimonial.
     * @return mixed
     */
    public function find(mixed $id): mixed;

    /**
     * Create a new testimonial.
     *
     * @param mixed $data The data for the new testimonial.
     * @return mixed
     */
    public function create(mixed $data): mixed;

    /**
     * Update an existing testimonial.
     *
     * @param mixed $data The new data for the testimonial.
     * @param mixed $id The ID of the testimonial to update.
     * @return mixed
     */
    public function update(mixed $data, mixed $id): mixed;

    /**
     * Delete a testimonial.
     *
     * @param mixed $id The ID of the testimonial to delete.
     * @return mixed
     */
    public function delete($id): mixed;

    /**
     * Paginate the testimonials.
     *
     * @param mixed $perPage The number of testimonials per page.
     * @return mixed
     */
    public function paginate(mixed $perPage): mixed;
}
