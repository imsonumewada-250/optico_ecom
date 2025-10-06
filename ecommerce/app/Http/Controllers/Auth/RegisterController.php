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

    // Handle form submit
    public function register(Request $request)
    {
   

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => 'customer',
        ]);

        Auth::login($user); // auto login after registration

        return redirect('/')->with('success', 'Registration successful!');
    }
}
