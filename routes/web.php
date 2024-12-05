<?php

use App\Models\SchoolClass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\TeacherClassController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserTransactionController;
use App\Models\TeacherClass;
use App\Models\UserTransaction;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/student/information',[StudentController::class, 'information'])->name('student.information');
Route::get('/api/student-info/{identityNo}', [StudentController::class, 'getStudentInfo']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[HomeController::class, 'index_admin'])->name('dashboard');
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

    Route::get('/student-classes/promote/{ids}/{classId}/{promotedYear}', [StudentClassController::class, 'set_promote'])
        ->name('student-classes.set.promote')
        ->middleware('role:superadmin|admin');

    Route::get('/student-classes/graduated/{ids}/', [StudentClassController::class, 'set_graduated'])
        ->name('student-classes.set.graduated')
        ->middleware('role:superadmin|admin');

    Route::delete('/student-classes/delete/{student_id}/{academic_year_id}',[StudentClassController::class, 'destroy'])
        ->name('student-classes.delete')
        ->middleware('role:superadmin|admin');

    Route::get('/student-classes/demoted/{ids}/{classId}/{promotedYear}', [StudentClassController::class, 'set_demoted'])
        ->name('student-classes.set.demoted')
        ->middleware('role:superadmin|admin');

    Route::resource('student-classes', StudentClassController::class)
        ->middleware('role:superadmin|admin');
        
    Route::resource('teacher-classes', TeacherClassController::class)
        ->middleware('role:superadmin|admin');

    Route::put('/transaction/success/{transaction:id}',[TransactionController::class, 'set_approved'])
        ->middleware('role:superadmin|admin')
        ->name('transaction.approve');

    Route::put('/transaction/reject/{transaction:id}',[TransactionController::class, 'set_rejected'])
        ->middleware('role:superadmin|admin')
        ->name('transaction.reject');

    Route::get('/transaction/history',[TransactionController::class, 'history'])
        ->middleware('role:superadmin|admin')
        ->name('transaction.history');

    Route::resource('transaction', TransactionController::class)
        ->middleware('role:superadmin|admin');

    Route::resource('report',ReportController::class)
        ->middleware('role:superadmin|admin');

    Route::prefix('client')->name('client.')->group(function () {
        Route::put('/transaction/cancel/{transaction:id}',[UserTransactionController::class,'set_cancel'])
        ->middleware('role:parent')
        ->name('transaction.cancel');

        Route::resource('transaction',UserTransactionController::class)
        ->middleware('role:parent');

        Route::resource('dashboard',HomeController::class)
        ->middleware('role:parent');
    });
 
});


require __DIR__.'/auth.php';
