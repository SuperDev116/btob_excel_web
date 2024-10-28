<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;

// Route::view('/', 'welcome');

Route::view('terms', 'terms')->name('terms');

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
        // 'subject.exams' => ExamController::class
    ]);
    
    Route::get('subjects/{subject}/exams/{selected_exam?}', [ExamController::class, 'index'])->name('subject.exams.index');

    Route::get('/subject/{subject}/print', [SubjectController::class, 'print'])->name('print.subject');
    Route::get('/exam/{exam}/print', [ExamController::class, 'print'])->name('print.exam');

    Route::get('/csv_download', [SubjectController::class, 'csv_download'])->name('csv_download');
});

require __DIR__.'/auth.php';
