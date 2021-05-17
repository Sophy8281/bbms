<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HostDrive;

class HostDriveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HostDrive::create([
            'name' => 'host1',
            'organization' => 'KPLC',
            'population' => '30',
            'email' => 'kplc@gmail.com',
            'phone' => '0720012345',
            'location' => 'KPLC Nairobi',
            'date' => '2021-05-20',
            'bank_id' => '1',
            'comment' => 'comment',
        ]);
    }
}
