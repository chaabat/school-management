<?php

use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubjectToClasseController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeacherToClasseController;
use App\Http\Controllers\Admin\TimeTableController;
use App\Http\Controllers\Auth\AuthentificationController;
use App\Http\Controllers\Parent\ParentsController;
use App\Http\Controllers\Student\StudentsController;
use App\Http\Controllers\Teacher\TeachersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/unauthorized', function () {
    return response()->view('errors.403', [], 403);
})->name('unauthorized');

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');


Route::get('/', function () {   
    return view('home');
});
/*************************************************** AUTHENTIFICATION ***********************************************************************/
Route::get('login', [AuthentificationController::class, 'index'])->name('login.page');
Route::post('login', [AuthentificationController::class, 'store'])->name('login');

Route::get('/forgot-password', [AuthentificationController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/forgot-password', [AuthentificationController::class, 'forgotPasswordPost'])->name('forgot');
Route::get('/reset-password/{token}', [AuthentificationController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-password', [AuthentificationController::class, 'resetPasswordPost'])->name('reset');

Route::get('/check-your-email', [AuthentificationController::class, 'waitPage'])->name('waitPage');
Route::post('logout', [AuthentificationController::class, 'destroy'])->name('logout');

/*************************************************** TEACHERS ***********************************************************************/

Route::resource('teachers', TeacherController::class);
Route::get('/search-teachers', [TeacherController::class, 'search'])->name('search.teachers');




/*************************************************** STUDENTS ***********************************************************************/

Route::resource('students', StudentController::class);
Route::get('/search-students', [StudentController::class, 'search'])->name('search.students');
Route::get('/student-parent/{id}', [StudentController::class, 'myParent'])->name('myParent');

/*************************************************** PARENTS ***********************************************************************/

Route::resource('parents', ParentController::class);
Route::get('/search-parents', [ParentController::class, 'search'])->name('search.parents');
Route::get('/parent-student/{id}', [ParentController::class, 'myStudent'])->name('myStudent');



/*************************************************** ADMIN CLASSES ***********************************************************************/


Route::group(['prefix' => 'classes'], function () {
    Route::get('/', [ClasseController::class, 'index'])->name('admin.class');
    Route::post('/', [ClasseController::class, 'store'])->name('create.class');
    Route::delete('/{id}', [ClasseController::class, 'destroy'])->name('delete.class');
    Route::get('{id}/edit', [ClasseController::class, 'edit'])->name('edit.class');
    Route::put('/{id}', [ClasseController::class, 'update'])->name('update.class');
    Route::get('/search',[ClasseController::class, 'search'])->name('search.class');

});

/*************************************************** ADMIN SUBJECTS ***********************************************************************/

Route::group(['prefix' => 'subjects'], function () {
    Route::get('/', [SubjectController::class, 'index'])->name('admin.subject');
    Route::post('/', [SubjectController::class, 'store'])->name('create.subject');
    Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('delete.subject');
    Route::get('{id}/edit', [SubjectController::class, 'edit'])->name('edit.subject');
    Route::put('/{id}', [SubjectController::class, 'update'])->name('update.subject');
    Route::get('/search',[SubjectController::class, 'search'])->name('search.subject');

});
/*************************************************** ADMIN SUBJECT TO CLASSE ***********************************************************************/

Route::group(['prefix' => 'subject-to-class'], function () {
    Route::get('/', [SubjectToClasseController::class, 'index'])->name('assignSubjectToClass');
    Route::post('/', [SubjectToClasseController::class, 'store'])->name('createSubjectToClasse');
    Route::delete('/{id}', [SubjectToClasseController::class, 'destroy'])->name('deleteSubjectToClasse');
    Route::get('{id}/edit', [SubjectToClasseController::class, 'edit'])->name('editSubjectToClasse');
    Route::put('/{id}', [SubjectToClasseController::class, 'update'])->name('updateSubjectToClasse');
    Route::get('/search',[SubjectToClasseController::class, 'search'])->name('searchSubjectToClasse');

});


/*************************************************** ADMIN TEACHER TO CLASSE ***********************************************************************/

Route::group(['prefix' => 'teacher-to-classe'], function () {
    Route::get('/', [TeacherToClasseController::class, 'index'])->name('teacherToClasse');
    Route::post('/', [TeacherToClasseController::class, 'store'])->name('createTeacherToClasse');
    Route::delete('/{id}', [TeacherToClasseController::class, 'destroy'])->name('deleteTeacherToClasse');
    Route::get('{id}/edit', [TeacherToClasseController::class, 'edit'])->name('editTeacherToClasse');
    Route::put('/{id}', [TeacherToClasseController::class, 'update'])->name('updateTeacherToClasse');
    Route::get('/search',[TeacherToClasseController::class, 'search'])->name('searchTeacherToClasse');

});
/*************************************************** ADMIN TIME TABLE ***********************************************************************/

Route::resource('timeTable',TimeTableController::class);

/*************************************************** PARENTS ***********************************************************************/

Route::group(['middleware' => ['auth', 'role:parent']], function () {
    Route::get('/parent/dashboard',[ParentsController::class, 'index'])->name('parentDashboard');
    Route::get('/myChildren',[ParentsController::class, 'myChildren'])->name('myChildren');
    Route::get('/myChildren/classe-subjects/{id}',[ParentsController::class, 'myChildrenSubjects'])->name('myChildrenSubjects');
});

/*************************************************** STUDENTS ***********************************************************************/

Route::group(['middleware' => ['auth', 'role:student']], function () {
Route::get('/student/dashboard',[StudentsController::class, 'index'])->name('studentDashboard');
Route::get('/mySubjects',[StudentsController::class, 'mySubject'])->name('mySubject');
});


/*************************************************** TEACHERS ***********************************************************************/



Route::group(['middleware' => ['auth', 'role:teacher']], function () {
    Route::get('/teacher/dashboard',[TeachersController::class, 'index'])->name('teacherDashboard');
    Route::get('/myClasse',[TeachersController::class, 'myClasse'])->name('myClasse');
});