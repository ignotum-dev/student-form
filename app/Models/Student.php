<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'course_id', //foreign key
        'year',
        'dob',
        'age',
        'sex',
        'c_address',
        'h_address',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
