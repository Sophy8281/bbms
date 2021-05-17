<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
            'bank_id' => '1',
            'name' => 'Staff1',
            'email' => 'staff1@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        Staff::create([
            'bank_id' => '2',
            'name' => 'Staff2',
            'email' => 'staff2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
