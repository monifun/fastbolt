<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->get()->each(function ($user) {
            DB::table('wallets')->insert([
                'ownable_type' => 'user',
                'ownable_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });
    }
}
