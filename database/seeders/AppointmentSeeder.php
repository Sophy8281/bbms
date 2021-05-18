<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::create([
            'user_id' => '1',
            'name' => 'Donor1',
            'email' => 'donor1@gmail.com',
            'phone' => '0718875113',
            'date' => '2021-05-20',
            'bank_id' => '1',
            'blood_group' => 'A+',
        ]);
    }
}
