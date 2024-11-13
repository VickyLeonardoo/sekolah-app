<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\TeacherController;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::PUT('teacher/{teacher:id}/update-photo', [TeacherController::class, 'updatePhoto'])
        ->name('teacher.update-photo')
        ->middleware('role:superadmin');


    Route::resource('major', MajorController::class)
        ->middleware('role:superadmin');

    Route::resource('teacher', TeacherController::class)
        ->middleware('role:superadmin');

    Route::resource('school-class', SchoolClassController::class)
        ->middleware('role:superadmin');

    Route::resource('academic-year', AcademicYearController::class)
        ->middleware('role:superadmin');

});

require __DIR__.'/auth.php';
