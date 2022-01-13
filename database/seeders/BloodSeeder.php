<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blood;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blood::create([
            'donation_id' => '1',
            'bank_id' => '1',
            'Staff_id' => '1',
            'bag_serial_number' => '00100',
            'group_id' => '1',
            'donation_date' => '2021-04-20',
            'expiry_date' => '2021-06-01',
        ]);
    }
}