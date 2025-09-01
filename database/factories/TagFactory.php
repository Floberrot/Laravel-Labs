<?php

namespace Database\Factories;

use App\Enums\TagEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = array_map(fn(TagEnum $enum) => $enum->value, TagEnum::cases());
        return [
            'name' => $names[array_rand(TagEnum::cases())],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
