<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plasma;

class PlasmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plasma::create([
            'bank_id' => '1',
            'Staff_id' => '1',
            'freezer_id' => '1',
            'bag_serial_number' => '0201',
            'group_id' => '1',
            'donation_date' => '2021-04-20',
            'expiry_date' => '2022-04-20',
        ]);
    }
}
