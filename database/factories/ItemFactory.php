<?php

namespace Database\Factories;

use App\Enums\PostTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(1),
            'description'=>fake()->paragraph(3),
            'location'=>fake()->address(),
            'post_type'=>fake()->randomElement(PostTypeEnum::cases()),
            'lost_at'=>fake()->dateTimeBetween('-1 year', 'now'),
            'found_at'=>fake()->dateTimeBetween('-1 year', 'now')
        ];
    }
}
