<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hospital::create(['name' => 'KNH','email' => 'knh@hospital.org','phone' => '0740123456','county' => 'Nairobi',]);
        Hospital::create(['name' => 'Mbagathi','email' => 'mbagathi@hospital.org','phone' => '0741123456','county' => 'Nairobi',]);
    }
}
