<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
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
        // Generate the same name for both User and Student
        $firstName = fake()->firstName;
        $middleName = fake()->optional()->firstName;
        $lastName = fake()->lastName;
        $fullName = trim("{$firstName} {$middleName} {$lastName}");

        // Generate a random date of birth between 18 and 50 years ago
        $dob = fake()->dateTimeBetween('-50 years', '-18 years');

        return [
            'user_id' => User::factory()->state(['name' => $fullName]), // Use the same name for User
            'student_number' => (string) fake()->unique()->numerify('01223#####'),
            'first_name' => $firstName,
            'middle_name' => $middleName, // Nullable field
            'last_name' => $lastName,
            'course_id' => Course::pluck('id')->random(),
            'year' => fake()->randomElement(['First Year', 'Second Year', 'Third Year', 'Fourth Year']),
            'dob' => $dob,
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
