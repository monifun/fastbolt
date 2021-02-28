<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->get()->each(function ($wallet) {
            DB::table('transactions')->insert([
                'wallet_id' => $wallet->id,
                'type' => 'deposit',
                'status' => 'completed',
                'amount' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
