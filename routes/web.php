<?php

use App\Http\Controllers\AdminController;
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

Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
Route::get('admins',[AdminController::class,'admin'])->name('admin.page');


Route::get('parents',[AdminController::class,'parent'])->name('parent.page');
Route::get('parents/add',[AdminController::class,'addParent'])->name('add.parent');
Route::get('parents/update',[AdminController::class,'updateParent'])->name('update.parent');


Route::get('teachers',[AdminController::class,'teacher'])->name('teacher.page');
Route::get('teachers/add',[AdminController::class,'addTeacher'])->name('add.teacher');
Route::get('teachers/update',[AdminController::class,'updateTeacher'])->name('update.teacher');


Route::get('students',[AdminController::class,'student'])->name('student.page');
Route::get('students/add',[AdminController::class,'addStudent'])->name('add.student');
Route::get('students/update',[AdminController::class,'updateStudent'])->name('update.student');
