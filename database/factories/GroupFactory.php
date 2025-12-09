<?php

namespace Database\Factories;

use App\Models\NaturePark;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Group',
            'description' => fake()->sentence(),
            'code' => strtoupper(fake()->bothify('???###')),
            'code_expires_at' => now()->addDays(21),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(fn($group) => NaturePark::factory()->create(['group_id' => $group->id, 'state' => 0])
        );
    }
}
