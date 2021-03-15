<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed admin user
        DB::table('users')->insert([
            [
                'name' => 'Duong Truong',
                'email' => 'duong@novabolt.dev',
                'phone' => phone('0888888888', 'VN'),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'Tran Thanh Long',
                'email' => 'long@novabolt.dev',
                'phone' => phone('0999999999', 'VN'),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        // insert bulk of users
        User::factory()->count(100)->create();
    }
}
