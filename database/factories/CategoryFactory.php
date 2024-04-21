<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->name;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text,
            'imageUrl' => $this->faker->imageUrl(),
        ];
    }
}
