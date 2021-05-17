<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'question' => 'How long does it take to donate blood?',
            'answer' => 'The donation process from the time you arrive until the time you leave takes about an hour. The donation itself is only about 8-10 minutes on average.',
            'status' => '1',
        ]);
        Faq::create([
            'question' => 'What are the requirements for one to donate?',
            'answer' => 'One must be healthy and not suffering from a cold, flu or other illness at the time of donation, be aged between 18 and 70 years, weigh at least 50 kg, have normal temperature and blood pressure and should not be under medication.',
            'status' => '1',
        ]);
    }
}
