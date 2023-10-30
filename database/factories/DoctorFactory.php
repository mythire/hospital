<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use App\Models\Speciality;
use Carbon\Carbon;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        $randomTime = Carbon::createFromTime(
            $this->faker->numberBetween(7, 21), // Random hour between 7 and 21 (inclusive)
            $this->faker->numberBetween(0, 59)  // Random minute between 0 and 59
        );


        return [
            'saluation' => $this->faker->randomElement(['Prof.','Dr.','Mr.', 'Mrs.', 'Miss.']),
            'speciality' => $this->faker->randomElement(['Chest Specialist','Cardiologist','Dentist','Dermatologist','General Physician']),
            'day' => $this->faker->dayOfWeek(),
            'fees' => 2000.0,
            'time' => $randomTime,

        ];
    }
}
