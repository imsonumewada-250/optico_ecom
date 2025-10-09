<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login request (no bcrypt)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Find user by email
        $user = User::where('email', $credentials['email'])->first();

        // ✅ Simple plain-text password match
        if ($user && $user->password === $credentials['password']) {
            // Manual login
            auth()->login($user);
            $request->session()->regenerate();
            return redirect()->intended('/home')->with('success', 'Login successful!');
        }

        // ❌ Invalid login
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
