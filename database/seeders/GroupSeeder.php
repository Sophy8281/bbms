<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create(['admin_id' => '1','name' => 'A+',]);
        Group::create(['admin_id' => '1','name' => 'B+',]);
        Group::create(['admin_id' => '1','name' => 'AB+',]);
        Group::create(['admin_id' => '1','name' => 'A-',]);
        Group::create(['admin_id' => '1','name' => 'B-',]);
        Group::create(['admin_id' => '1','name' => 'AB-',]);
        Group::create(['admin_id' => '1','name' => 'O+',]);
        Group::create(['admin_id' => '1','name' => 'O-',]);
    }
}
