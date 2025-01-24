<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url'    => fake()->url(),
            'width'  => fake()->numberBetween(1, 100),
            'height' => fake()->numberBetween(1, 100),
            'color'  => '#' . fake()->numberBetween(112233, 667788),
        ];
    }
}
