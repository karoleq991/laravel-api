<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => fake()->firstName(),
            'ean' => fake()->ean8(),
            'sku' => Str::random(5),
            'shop_id' => Shop::factory(),
        ];
    }
}
