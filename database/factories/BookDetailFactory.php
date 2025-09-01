<?php

namespace Database\Factories;

use App\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isbn' => $this->faker->unique()->isbn10(),
            'pages' => $this->faker->numberBetween(100, 500),
            'price' => [
                'amount' => $this->faker->randomFloat(2, 5, 45),
                'currency' => CurrencyEnum::EURO->value
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
