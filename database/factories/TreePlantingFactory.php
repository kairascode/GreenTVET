<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TreePlanting;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TreePlanting>
 */
class TreePlantingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = TreePlanting::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'growth_stage' => $this->faker->randomElement(['seedling', 'sapling', 'mature']),
        ];
    }
}
