<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dob' => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31'),
            'nic' => $this->faker->numerify("#########V"),
            'gender' => $this->faker->randomElement($array = array('male', 'female')),
            'address' => $this->faker->address
        ];
    }
}
