<?php

use App\Models\SchoolClass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\TeacherClassController;
use App\Models\TeacherClass;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/student/information',[StudentController::class, 'information'])->name('student.information');
Route::get('/api/student-info/{identityNo}', [StudentController::class, 'getStudentInfo']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::PUT('teacher/{teacher:id}/update-photo', [TeacherController::class, 'updatePhoto'])
        ->name('teacher.update-photo')
        ->middleware('role:superadmin|admin');

    Route::resource('major', MajorController::class)
        ->middleware('role:superadmin|admin');

    Route::resource('teacher', TeacherController::class)
        ->middleware('role:superadmin|admin');

    Route::resource('school-class', SchoolClassController::class)
        ->middleware('role:superadmin|admin');

    Route::resource('academic-year', AcademicYearController::class)
        ->middleware('role:superadmin|admin');

    Route::get('/student/import',[StudentController::class, 'show_import'])
        ->middleware('role:superadmin|admin')
        ->name('student.import.show');

    Route::post('/student/import',[StudentController::class, 'process_import'])
        ->middleware('role:superadmin|admin')
        ->name('student.import.process');

    Route::resource('student', StudentController::class)
        ->middleware('role:superadmin|admin');
        
    Route::post('/school-class/{school_class_id}/student/list/year/{academic_year_id}/store-student',[StudentClassController::class, 'store'])
        ->middleware('role:superadmin|admin')
        ->name('school-class.store.student');

    Route::get('/school-class/{school_class:id}/student/list/year/{academic_year:id}',[StudentClassController::class, 'index'])
        ->middleware('role:superadmin|admin')
        ->name('school-class.student');
    
    Route::resource('student-classes', StudentClassController::class)
        ->middleware('role:superadmin|admin');

    Route::resource('teacher-classes', TeacherClassController::class)
        ->middleware('role:superadmin|admin');
});

require __DIR__.'/auth.php';
