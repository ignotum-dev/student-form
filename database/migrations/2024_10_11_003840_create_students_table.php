<?php

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('student_number');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->foreignIdFor(Course::class)->constrained()->onDelete('cascade'); //model class, cascade(course delete = user delete)
            $table->enum('year', ['First Year', 'Second Year', 'Third Year', 'Fourth Year']);
            $table->date('dob');
            $table->unsignedTinyInteger('age');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('c_address');
            $table->string('h_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
