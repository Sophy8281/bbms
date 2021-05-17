<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agitator;

class AgitatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agitator::create(['bank_id' => '1','admin_id' => '1','name' => 'Nairobi Agitator1','capacity' => '20',]);
        Agitator::create(['bank_id' => '2','admin_id' => '1','name' => 'Thika Agitator1','capacity' => '20',]);
    }
}
