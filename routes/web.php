<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\SavedListingController;
use App\Http\Controllers\MapController;

// Language switcher
Route::get('/language/{lang}', function ($lang) {
    $supported = ['en', 'lv'];
    if (in_array($lang, $supported)) {
        session()->put('locale', $lang);
        // Force set app locale for current request
        app()->setLocale($lang);
    }
    return redirect()->back()->with('message', 'Language changed successfully');
})->name('language.switch');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::view('/contact', 'contact');

// Jobs — public
Route::get('/jobs', [JobController::class, 'index']);

Route::get('/jobs/create', [JobController::class, 'create']);

Route::get('/jobs/{job}', [JobController::class, 'show']);

// Jobs — employer only
Route::middleware(['auth', 'employer'])->group(function () {
    Route::post('/jobs', [JobController::class, 'store']);
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
    Route::put('/jobs/{job}', [JobController::class, 'update']);
    Route::patch('/jobs/{job}', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
});

// Internships — public
Route::get('/internships', [InternshipController::class, 'index']);

Route::get('/internships/create', [InternshipController::class, 'create']);

Route::get('/internships/{internship}', [InternshipController::class, 'show']);

// Internships — employer only
Route::middleware(['auth', 'employer'])->group(function () {
    Route::get('/internships/create', [InternshipController::class, 'create']);
    Route::post('/internships', [InternshipController::class, 'store']);
    Route::get('/internships/{internship}/edit', [InternshipController::class, 'edit']);
    Route::put('/internships/{internship}', [InternshipController::class, 'update']);
    Route::patch('/internships/{internship}', [InternshipController::class, 'update']);
    Route::delete('/internships/{internship}', [InternshipController::class, 'destroy']);
});

// Map — public
Route::get('/map', [MapController::class, 'index'])->name('map.index');
Route::get('/api/map/listings', [MapController::class, 'data'])->name('map.data');
Route::get('/api/geocode', [MapController::class, 'geocode'])->name('map.geocode');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

// Auth required
Route::middleware('auth')->group(function () {
    // Profile & CV
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::get('/cv/generate', [CvController::class, 'form']);
    Route::post('/cv/generate', [CvController::class, 'generate']);
    Route::get('/cv/saved', [CvController::class, 'saved']);
    Route::delete('/cv/saved', [CvController::class, 'deleteSaved']);

    // Applications (job seekers)
    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::post('/applications', [ApplicationController::class, 'store']);
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy']);

    // Saved listings (job seekers / students)
    Route::get('/saved', [SavedListingController::class, 'index']);
    Route::post('/saved/toggle', [SavedListingController::class, 'toggle']);

    // Employer setup
    Route::get('/employer/create', [EmployerController::class, 'create']);
    Route::post('/employer', [EmployerController::class, 'store']);
    Route::get('/employer/{employer}/edit', [EmployerController::class, 'edit']);
    Route::patch('/employer/{employer}', [EmployerController::class, 'update']);

    // Employer dashboard
    Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index']);
    Route::get('/employer/applications', [EmployerDashboardController::class, 'applications']);
    Route::patch('/employer/applications/{application}/status', [EmployerDashboardController::class, 'updateStatus']);
});

// Admin panel
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole']);
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser']);
    Route::get('/jobs', [AdminController::class, 'jobs']);
    Route::delete('/jobs/{job}', [AdminController::class, 'deleteJob']);
    Route::get('/internships', [AdminController::class, 'internships']);
    Route::delete('/internships/{internship}', [AdminController::class, 'deleteInternship']);
    Route::get('/applications', [AdminController::class, 'applications']);
});
