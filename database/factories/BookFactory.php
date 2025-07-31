<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'isbn' => rand(1000,10000),
            'author_id' => 1,
            'publisher_id' => 1,
            'release_year' => now()->year,
            'price' => rand(10,1000),
            'stock' => 100,
        ];
    }
}
