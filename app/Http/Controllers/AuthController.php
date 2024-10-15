<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
        [
            'email' => 'required|email',
            'password'=> 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email'=> ['The provided credentials are incorrect.']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email'=> ['The provided credentials are incorrect.']
            ]);
        }

    }

    public function logout(Request $request)
    {
        
    }
}
