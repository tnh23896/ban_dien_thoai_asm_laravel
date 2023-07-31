<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        return [
            'invoice_id' => fake()->numberBetween(1, 10),
            'phone_id' => fake()->numberBetween(1, 10),
            'quantity' => fake()->randomNumber(2),
            'price' => fake()->numberBetween(900, 1000),
            'total' => fake()->numberBetween(900, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
