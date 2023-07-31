<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\MarketingBanner;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $randomId = User::select('id')->inRandomOrder()->first()->id;

        return [
            'category_id' => fake()->numberBetween(1, 10),
            'brand_id' => fake()->numberBetween(1, 10),
            'name' => fake()->word,
            'image' => 'images/phone.jpg',
            'price' => fake()->randomFloat(2, 100, 1000),
            'promotion_id' => fake()->numberBetween(1, 10),
            'quantity' => fake()->randomDigit,
            'description' => fake()->text,
            'banner_id' => fake()->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
