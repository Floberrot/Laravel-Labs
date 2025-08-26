<?php

namespace Database\Factories;

use App\Enums\LogTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence(),
            'type' => LogTypeEnum::INFO->value,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    public function error(): static
    {
        return $this->state(fn() => [
            'message' => '[ERROR] ' . $this->faker->sentence(),
            'type' => LogTypeEnum::EMERGENCY->value
        ]);
    }
}
