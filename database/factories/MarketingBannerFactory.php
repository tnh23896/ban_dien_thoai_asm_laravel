<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MarketingBanner>
 */
class MarketingBannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word,
            'description' => fake()->sentence,
            'image' => 'images/brand_01.png',
            'phone_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
