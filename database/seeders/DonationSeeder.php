<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donation;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donation::create([
            'staff_id' => '1',
            'donor_id' => '1',
            'bank_id' => '1',
            'bag_serial_number' => '00101',
            'group_id' => '1',
            'status' => '1',
        ]);
    }
}
