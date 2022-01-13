<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\About::factory()->create();
        // \App\Models\HospitalRequest::factory(3)->create();
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            BankSeeder::class,
            GroupSeeder::class,
            StaffSeeder::class,
            HospitalSeeder::class,
            AgitatorSeeder::class,
            FreezerSeeder::class,
            RefrigeratorSeeder::class,
            AppointmentSeeder::class,
            DonationSeeder::class,
            BloodSeeder::class,
            PlasmaSeeder::class,
            PlateletSeeder::class,
            RbcSeeder::class,
            FaqSeeder::class,
            DriveSeeder::class,
            HostDriveSeeder::class,
            HospitalRequestSeeder::class,
        ]);
    }
}