<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rbc;

class RbcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rbc::create([
            'bank_id' => '1',
            'Staff_id' => '1',
            'refrigerator_id' => '1',
            'bag_serial_number' => '0301',
            'group_id' => '1',
            'donation_date' => '2021-04-20',
            'expiry_date' => '2021-06-01',
        ]);
    }
}
