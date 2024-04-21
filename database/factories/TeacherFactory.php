<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'role' => $this->faker->randomElement(['admin', 'teacher']),
            'phone' => $this->faker->phoneNumber,
            'imageUrl' => $this->faker->imageUrl(),
            'description' => $this->faker->sentence,
            'user_id' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
