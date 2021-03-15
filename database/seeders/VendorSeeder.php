<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Market::all()->each(function ($market) {
            Vendor::factory()->for($market)->count(5)->create();
        });
    }
}
