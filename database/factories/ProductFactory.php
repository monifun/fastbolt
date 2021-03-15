<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'options' => [
                [
                    'label' => 'Size',
                    'value' => $this->faker->randomElement(['S', 'M', 'L', 'XL'])
                ], [
                    'label' => 'Color',
                    'value' => $this->faker->colorName
                ]
            ],
            'image' => $this->faker->imageUrl(400, 400, 'novabolt', false, null, true),
            'url' => $this->faker->url,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'quantity' => $this->faker->numberBetween(1, 5),
            'note' => $this->faker->sentence()
        ];
    }
}
