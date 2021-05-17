<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Refrigerator;

class RefrigeratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Refrigerator::create(['bank_id' => '1','admin_id' => '1','name' => 'Nairobi Refrigerator1','capacity' => '20',]);
        Refrigerator::create(['bank_id' => '2','admin_id' => '1','name' => 'Thika Refrigerator1','capacity' => '20',]);
    }
}
