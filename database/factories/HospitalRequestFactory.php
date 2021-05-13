<?php

namespace Database\Factories;

use App\Models\HospitalRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class HospitalRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HospitalRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hospital_ids = \DB::table('hospitals')->select('id')->get();
        $group_ids = \DB::table('groups')->select('id')->get();
        return [
            'hospital_id' => $this->faker->randomElement($hospital_ids)->id,
            'product' => 'red blood cells',//whole blood,plasma,platelets,red blood cells
            'group_id' => $this->faker->randomElement($group_ids)->id,
            // 'quantity' =>  $this->faker->randomDigitNotNull(),
            'quantity' => '4',
            'remaining' =>'4',
        ];
    }
}
