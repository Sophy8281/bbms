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
        $gender = ['Male', 'Female'];
        $group = ['A+', 'B+'];
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'gender' => 'Female',
            'unique_no'=> $this->faker->unique()->randomNumber(),
            'birth_date' => $this->faker->date($format = 'y-m-d', $max = '2004',$min = '1990'),
            'address'=> $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'blood_group' => 'B+',
            'county' => $this->faker->word,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}