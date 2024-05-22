<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/formations', [CourseController::class, 'index'])->name('courses.index');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/course/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::post('/toggleProgress', [CourseController::class, 'toggleProgress'])->name('courses.toggle');
    Route::get('/courses_create ', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/edit/{course}', [CourseController::class, 'edit']);
    Route::patch('/courses/edit/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');  
});
