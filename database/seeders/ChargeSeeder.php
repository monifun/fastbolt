<?php

namespace Database\Seeders;

use App\Enums\ChargeType;
use App\Models\Charge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('charges')->insert([
            [
                'name' => 'Phí dịch vụ mua hàng',
                'type' => ChargeType::FEE,
                'method' => 'percent',
                'target' => 'price',
                'value' => 5,
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'Phí dịch vụ kiểm đếm',
                'type' => ChargeType::FEE,
                'method' => 'fixed',
                'target' => 'quantity',
                'value' => 1,
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
