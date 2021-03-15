<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('markets')->insert([
            [
                'name' => 'Taobao',
                'website' => 'https://taobao.com',
                'currency_code' => 'CNY',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'Tmall',
                'website' => 'https://tmall.com',
                'currency_code' => 'CNY',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => '1688',
                'website' => 'https://1688.com',
                'currency_code' => 'CNY',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'WeChat',
                'website' => 'https://wechat.com',
                'currency_code' => 'CNY',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'Pinduoduo',
                'website' => 'https://tmall.com',
                'currency_code' => 'CNY',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
