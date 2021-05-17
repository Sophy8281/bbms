<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create(['admin_id' => '1','name' => 'Nairobi','email' => 'nairobi@bbms.org','phone' => '0730123456','county' => 'Nairobi',]);
        Bank::create(['admin_id' => '1','name' => 'Thika','email' => 'thika@bbms.org','phone' => '0731123456','county' => 'Kiambu',]);
        Bank::create(['admin_id' => '1','name' => 'Nyeri','email' => 'nyeri@bbms.org','phone' => '0732123456','county' => 'Nyeri',]);
        Bank::create(['admin_id' => '1','name' => 'Embu','email' => 'embu@bbms.org','phone' => '0733123456','county' => 'Embu',]);
    }
}
