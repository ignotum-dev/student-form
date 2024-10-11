<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'course_id', //foreign key
        'year',
        'dob',
        'sex',
        'c_address',
        'h_address',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
