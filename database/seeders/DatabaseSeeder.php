<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ChargeSeeder::class,
            WalletSeeder::class,
            TransactionSeeder::class,
            MarketSeeder::class,
            VendorSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
