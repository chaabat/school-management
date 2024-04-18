<?php

use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExamController;
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

Route::post('/send-message', [AuthentificationController::class, 'sendMessage'])->name('send-message');

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

Route::resource('classes', ClasseController::class);
Route::get('/search-classes',[ClasseController::class, 'search'])->name('search.class');

/*************************************************** ADMIN SUBJECTS ***********************************************************************/


Route::resource('subjects', SubjectController::class);
Route::get('/search-subjects',[SubjectController::class, 'search'])->name('search.subject');
/*************************************************** ADMIN EXAMS ***********************************************************************/

Route::resource('exams', ExamController::class);
Route::get('/search-exams',[ExamController::class, 'search'])->name('search.exams');

/*************************************************** ADMIN SUBJECT TO CLASSE ***********************************************************************/

Route::resource('subject-to-class', SubjectToClasseController::class);
Route::get('/search-subject-to-class',[SubjectToClasseController::class, 'search'])->name('searchSubjectToClasse');



/*************************************************** ADMIN TEACHER TO CLASSE ***********************************************************************/


Route::resource('teacher-to-class', TeacherToClasseController::class);

Route::get('/search-teacher-to-class',[TeacherToClasseController::class, 'search'])->name('searchTeacherToClasse');

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
Route::get('/Student-TimeTable',[StudentsController::class, 'myTimeTable'])->name('StudentTimeTable');
Route::get('/download-certificate', [StudentsController::class, 'downloadCertificate'])->name('certificate');
Route::get('/administration', [StudentsController::class, 'administration'])->name('administration');


});


/*************************************************** TEACHERS ***********************************************************************/



Route::group(['middleware' => ['auth', 'role:teacher']], function () {
    Route::get('/teacher/dashboard',[TeachersController::class, 'index'])->name('teacherDashboard');
    Route::get('/myClasse',[TeachersController::class, 'myClasse'])->name('myClasse');
    Route::get('/myTimeTable',[TeachersController::class, 'myTimeTable'])->name('myTimeTable');
});