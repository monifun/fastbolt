<?php

namespace Database\Seeders;

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
        DB::table('wallets')->delete();

        DB::table('users')->get()->each(function ($user) {
            DB::table('wallets')->insert([
                'ownable_type' => 'App\Models\User',
                'ownable_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });
    }
}
