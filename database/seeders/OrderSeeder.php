<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('users')->get()->each(function ($user) use ($faker) {
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $user->id,
                'vendor_id' => DB::table('vendors')->inRandomOrder()->first()->id,
                'currency_code' => 'CNY',
                'currency_rate' => '3600',
                'shipping_name' => $user->name,
                'shipping_phone' => $user->phone,
                'shipping_address' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            for ($product_count = 0; $product_count < random_int(2, 7); $product_count++) {
                DB::table('products')->insert([
                    'order_id' => $orderId,
                    'name' => $faker->sentence(),
                    'options' => json_encode([
                        [
                            'label' => 'Size',
                            'value' => $faker->randomElement(['S', 'M', 'L', 'XL'])
                        ], [
                            'label' => 'Color',
                            'value' => $faker->colorName
                        ]
                    ]),
                    'image' => $faker->imageUrl(400, 400, 'fastbolt', false, null, true),
                    'url' => $faker->url,
                    'price' => $faker->randomFloat(2, 10, 100),
                    'quantity' => $faker->numberBetween(1, 5),
                    'note' => $faker->sentence(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
