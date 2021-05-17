<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Freezer;

class FreezerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Freezer::create(['bank_id' => '1','admin_id' => '1','name' => 'Nairobi Freezer1','capacity' => '20',]);
        Freezer::create(['bank_id' => '2','admin_id' => '1','name' => 'Thika Freezer1','capacity' => '20',]);
    }
}
