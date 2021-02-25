<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::factory()->count(1000)->for(Market::factory())->create();
    }
}
