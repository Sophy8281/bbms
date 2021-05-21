<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Donor1',
            'email' => 'donor@gmail.com',
            'email_verified_at' => now(),
            'gender' => 'Female',
            'unique_no'=> '3226',
            'birth_date' => '1992-05-20',
            'address'=> '50 Gakungu',
            'phone' => '0718875113',
            'blood_group' => 'A+',
            'county' => 'Vihiga',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Donor2',
            'email' => 'donor2@gmail.com',
            'email_verified_at' => now(),
            'gender' => 'Male',
            'unique_no'=> '23321223',
            'birth_date' => '1990-01-20',
            'address'=> '50 Gakungu',
            'phone' => '0720123456',
            'blood_group' => 'B+',
            'county' => 'Kiambu',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Donor3',
            'email' => 'donor3@gmail.com',
            'email_verified_at' => now(),
            'gender' => 'Female',
            'unique_no'=> '26253223',
            'birth_date' => '1994-01-20',
            'address'=> '50 Koomeni',
            'phone' => '0721123456',
            'blood_group' => 'AB+',
            'county' => 'Nakuru',
            'password' => bcrypt('12345678'),

        ]);
    }
}
