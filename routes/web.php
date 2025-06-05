<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;

Route::get('test', function () {
    $job = Job::first();
    TranslateJob::dispatch($job);
    return 'Done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

// Jobs
Route::resource('jobs', JobController::class);

Route::resource('internships', InternshipController::class);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
