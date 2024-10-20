<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;

// Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function ()
{
    Route::view('/', 'dashboard');
    
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');
    
    Route::view('profile', 'profile')->name('profile');

    Route::resources([
        'users' => UserController::class,
        'subjects' => SubjectController::class,
        'subject.exams' => ExamController::class
    ]);
});

require __DIR__.'/auth.php';
