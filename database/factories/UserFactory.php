<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_name_lines = file(database_path('seeders/data/first_name.txt'));
        $last_name_lines = file(database_path('seeders/data/last_name.txt'));
        $full_name = trim($this->faker->randomElement($first_name_lines)).' '.trim($this->faker->randomElement($last_name_lines));

        return [
            'name' => $full_name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => phone('091'.$this->faker->unique()->randomNumber(7, true), 'VN'),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
