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
    public function definition(): array
    {
        return [
           'name'=>$this->faker->name,
           'email'=>$this->faker->email,
           'password'=>$this->faker->password,
           'phone'=>$this->faker->phoneNumber,
           'course_id'=>$this->faker->biasedNumberBetween($min = 1, $max = 6, $function = 'sqrt')
        ];
    }
}
