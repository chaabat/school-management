<?php


use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::resource('admin', AdminController::class);

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
    Route::post('/', [RegisterAdminController::class, 'store'])->name('ajouterAdmin');
    Route::get('/add', [AdminPagesController::class, 'addAdmin'])->name('add.admin');
    Route::get('/update/{id}/edit/  ', [AdminPagesController::class, 'updateAdmin'])->name('update.admin');
    Route::put('/update/{id}', [RegisterAdminController::class, 'update'])->name('modifierAdmin');
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
