<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drive;

class DriveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Drive::create([
            'bank_id' => '1',
            'staff_id' => '1',
            'location' => 'Thika Stadium',
            'date' => '2021-05-20',
            'time' => '9am-5pm',
        ]);
        Drive::create([
            'bank_id' => '2',
            'staff_id' => '2',
            'location' => 'Ihura Stadium',
            'date' => '2021-05-20',
            'time' => '9am-5pm',
        ]);
    }
}
