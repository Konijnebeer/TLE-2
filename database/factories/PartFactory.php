<?php

namespace Database\Factories;

use App\Models\Quest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Part>
 */
class PartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quest_id' => Quest::factory(),
            'order_index' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'media_url' => $this->faker->optional()->imageUrl(),
            'success_condition' => $this->faker->optional()->text(100),
        ];
    }
}
