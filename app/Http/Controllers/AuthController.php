<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Update your login method
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful! Welcome back.',
                    'redirect' => route('success')
                ]);
            }
            
            return redirect()->route('success')->with('success', 'Login successful! Welcome back.');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.'
            ], 422);
        }

        return redirect()->route('home')->with('error', 'Invalid email or password.');
    }

    // Update your register method
    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/'
            ],
            'confirm_password' => 'required|same:password',
            'subscribed' => 'nullable|boolean',
        ], [
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one letter and one number.',
            'confirm_password.same' => 'Password confirmation does not match.',
            'email.unique' => 'This email address is already registered.',
        ]);

        $user = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'subscribed' => $request->has('subscribed') ? 1 : 0,
        ]);

        Auth::login($user);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Welcome to our platform.',
                'redirect' => route('success')
            ]);
        }

        return redirect()->route('success')->with('success', 'Registration successful! Welcome to our platform.');
    }

    // Success page after login/register
    public function success()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            return view('page.success', compact('user'));
        }

        // If user is not authenticated, redirect to home page
        return redirect()->route('home')->with('error', 'Please log in to access this page.');
    }

    // Logout method
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }

    // Email availability checker
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'available' => !$exists
        ]);
    }
}