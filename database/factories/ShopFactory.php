<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Shop::class;

    public function definition()
    {
        return [
            'name' => fake()->domainName(),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
        ];
    }
}
