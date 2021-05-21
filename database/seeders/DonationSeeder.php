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
            'bag_serial_number' => 'N00101',
            'group_id' => '1',
            'status' => 'Safe',
        ]);
        Donation::create([
            'staff_id' => '1',
            'donor_id' => '2',
            'bank_id' => '1',
            'bag_serial_number' => 'N00102',
            'group_id' => '2',
            'status' => 'Safe',
        ]);
        Donation::create([
            'staff_id' => '1',
            'donor_id' => '3',
            'bank_id' => '1',
            'bag_serial_number' => 'N00103',
            'group_id' => '3',
            'status' => 'Safe',
        ]);
    }
}
