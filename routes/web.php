<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\AdminController;

// Home & Contact
Route::view('/', 'home');
Route::view('/contact', 'contact');

// Jobs (public)
Route::resource('jobs', JobController::class);

// Internships (public)
Route::resource('internships', InternshipController::class);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

// Profile (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // Applications
    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::post('/applications', [ApplicationController::class, 'store']);
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy']);

    // Employer profile
    Route::get('/employer/create', [EmployerController::class, 'create']);
    Route::post('/employer', [EmployerController::class, 'store']);
    Route::get('/employer/{employer}/edit', [EmployerController::class, 'edit']);
    Route::patch('/employer/{employer}', [EmployerController::class, 'update']);
});

// Admin panel
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole']);
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser']);
    Route::get('/jobs', [AdminController::class, 'jobs']);
    Route::delete('/jobs/{job}', [AdminController::class, 'deleteJob']);
});
