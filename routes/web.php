<?php

use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login.page');
Route::post('login', [LoginController::class, 'store'])->name('login');


Route::get('dashboard', [AdminPagesController::class, 'dashboard'])->name('admin.dashboard');
Route::get('courses', [AdminPagesController::class, 'course'])->name('admin.course');
Route::get('classes', [AdminPagesController::class, 'class'])->name('admin.class');




Route::prefix('admins')->group(function () {
    Route::get('/', [AdminPagesController::class, 'admin'])->name('admin.page');
    Route::post('/', [RegisterController::class, 'admin'])->name('ajouterAdmin');
    Route::get('/add', [AdminPagesController::class, 'addAdmin'])->name('add.admin');
    Route::get('/update', [AdminPagesController::class, 'updateAdmin'])->name('update.admin');
});

Route::prefix('parents')->group(function () {
    Route::get('/', [AdminPagesController::class, 'parent'])->name('parent.page');
    Route::get('/add', [AdminPagesController::class, 'addParent'])->name('add.parent');
    Route::get('/update', [AdminPagesController::class, 'updateParent'])->name('update.parent');
});

Route::prefix('teachers')->group(function () {
    Route::get('/', [AdminPagesController::class, 'teacher'])->name('teacher.page');
    Route::get('/add', [AdminPagesController::class, 'addTeacher'])->name('add.teacher');
    Route::get('/update', [AdminPagesController::class, 'updateTeacher'])->name('update.teacher');
});

Route::prefix('students')->group(function () {
    Route::get('/', [AdminPagesController::class, 'student'])->name('student.page');
    Route::get('/add', [AdminPagesController::class, 'addStudent'])->name('add.student');
    Route::get('/update', [AdminPagesController::class, 'updateStudent'])->name('update.student');
});
