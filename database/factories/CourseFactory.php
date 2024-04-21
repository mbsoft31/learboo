<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'imageUrl' => $this->faker->imageUrl(),
            'categorySlug' => $this->faker->slug,
            'teacherId' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'publishedAt' => $this->faker->dateTime(),
        ];
    }
}
