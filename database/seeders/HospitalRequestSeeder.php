<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HospitalRequest;

class HospitalRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HospitalRequest::create([
            'hospital_id' => '1',
            'product' => 'whole blood',//whole blood,plasma,platelets,red blood cells
            'group_id' => '1',
            'quantity' => '1',
            'remaining' => '1',
        ]);
        HospitalRequest::create([
            'hospital_id' => '2',
            'product' => 'plasma',//whole blood,plasma,platelets,red blood cells
            'group_id' => '2',
            'quantity' => '2',
            'remaining' => '2',
        ]);
    }
}
