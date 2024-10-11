<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            'BSCS',
            'BSIT MOBDEV',
            'BSIT NETAD',
            'BSEMC'
        ];

        foreach ($courses as $course) {
            Course::create([
                'courses' => $course
            ]);
        }
    }
}
