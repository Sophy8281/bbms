<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = About::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'history' => 'The Donate Blood Service is the National Blood Service responsible for all blood donation and safety activities for the entire country. The Donate Blood Service was established as an autonomous institution and commissioned in May 2021 by a Board of Directors. It operates within the framework of the National Health Policy (NHP) and the Health Sector Strategic Plan HSSP). The Donate Blood Service is a centrally coordinated department in the Ministry of Health with efficient central coordination sufficiently decentralized to render service to all regions of the country. The headquarters at Nairobi Blood Bank acts as a reference centre for the regional blood banks and other public and private hospitals. The blood collection depends on healthy volunteer donors with least risk for Transfusion Transmissible Infections(TTIs).It has grown from a service supplying blood in countrywide. At the start blood collection was mainly replacement donation and hardly any Voluntary Non-Remunerated Blood Donors (VNRBD). The percentage of VNRBD has been increasing gradually.',
            'vision' => 'An effective, efficient and sustainable Blood Transfusion Service in Uganda.',
            'mission' => 'To provide sufficient and efficacious blood and blood components through voluntary donations for appropriate use in health care service delivery.',
            'values' => 'Proffessionalism, Altruism, Accountable and Excellence.',
            'objectives'=> 'To expand blood transfusion Infrastructure to operate adequately within a decentralized healthcare delivery system. To increase the annual blood collection necessary to meet the transfusion needs for all patients in the country.To operate an active nationwide quality assurance program that ensures blood safety. To promote appropriate clinical use of blood. To strengthen the organizational capacity of UBTS to enable efficient and effective service delivery.',
        ];
    }
}
