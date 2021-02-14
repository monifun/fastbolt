<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_code' => 'CNY',
            'currency_rate' => 3500,
            'shipping_name' => $this->faker->name,
            'shipping_phone' => phone('091'.$this->faker->unique()->randomNumber(7, true), 'VN'),
            'shipping_address' => $this->faker->address
        ];
    }
}
