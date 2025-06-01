<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home page (account.blade.php) - Your modern login/register page
Route::get('/', function () {
    return view('page.account');
})->name('home');

// Alternative route name for consistency (optional)
Route::get('/auth', function () {
    return view('page.account');
})->name('auth');

// Login - Handle POST request from the modern login form
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Register - Handle POST request from the modern register form
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Add this route to handle email checking
Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('check.email');

// Success page - Show after successful login/registration
Route::get('/success', function () {
    return view('page.success');
})->name('success');

// Logout - Changed to POST for security (with CSRF protection)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Optional: Keep GET logout for backward compatibility, but redirect to POST
Route::get('/logout', function () {
    return redirect()->route('home')->with('info', 'Please use the logout button to sign out securely.');
})->name('logout.get');