<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
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
            'email' => $this->faker->safeEmail(),
            'testimonial' => $this->faker->sentence,
            'position' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'imageUrl' => $this->faker->imageUrl(),
        ];
    }
}
