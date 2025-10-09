<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Handle registration (no bcrypt)
    public function register(Request $request)
    {
        // ✅ Basic validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed', // checks password_confirmation
        ]);

        // ✅ Create new user with plain password
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,  // ❗ plain password (no bcrypt)
            'role'     => 'customer',
        ]);

        // ✅ Auto-login the new user
        Auth::login($user);

        // ✅ Redirect to home
        return redirect('/home')->with('success', 'Registration successful!');
    }
}
