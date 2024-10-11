<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Course;
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
        // Generate a random date of birth between 18 and 25 years ago
        $dob = fake()->dateTimeBetween('-50 years', '-18 years');

        return [
            'student_number' => (string) fake()->unique()->numerify('01223#####'),
            'first_name' => fake()->firstName,
            'middle_name' => fake()->optional()->firstName, // Nullable field
            'last_name' => fake()->lastName,
            'course_id' => Course::pluck('id')->random(),
            'year' => fake()->randomElement(['First Year', 'Second Year', 'Third Year', 'Fourth Year']),
            'dob' => $dob, // Generate a DOB
            'age' => $this->calculateAge($dob),
            'sex' => fake()->randomElement(['Male', 'Female']),
            'c_address' => fake()->address,
            'h_address' => fake()->address,
        ];
    }

    private function calculateAge($dob)
    {
        return Carbon::parse($dob)->age;
    }
}
