<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_number' => 'required|string|max:255|unique:students,student_number',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'year' => 'required|in:First Year,Second Year,Third Year,Fourth Year',
            'dob' => 'required|date',
            'age' => 'required|integer|min:18|max:100',
            'sex' => 'required|in:Male,Female',
            'c_address' => 'required|string|max:255',
            'h_address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',  // User email
            'password' => 'required|string|min:8|confirmed', // Password confirmation
        ]);        

        $user = User::create([
            'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Step 2: Create a Student linked to the User
        $student = Student::create([
            'user_id' => $user->id, // Link the student to the user
            'student_number' => $validatedData['student_number'],
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'course_id' => $validatedData['course_id'],
            'year' => $validatedData['year'],
            'dob' => $validatedData['dob'],
            'age' => $validatedData['age'],
            'sex' => $validatedData['sex'],
            'c_address' => $validatedData['c_address'],
            'h_address' => $validatedData['h_address'],
        ]);

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'year' => 'required|in:First Year,Second Year,Third Year,Fourth Year',
            'dob' => 'required|date',
            'age' => 'required|integer|min:18|max:100',
            'sex' => 'required|in:Male,Female',
            'c_address' => 'required|string|max:255',
            'h_address' => 'required|string|max:255',
        ]);

        $student->update($validatedData);
        return response()->json($student, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json('Deleted successfully');
    }
}
