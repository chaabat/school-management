<?php

use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Auth\AuthentificationController;

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
    return view('home');
});

Route::get('login', [AuthentificationController::class, 'index'])->name('login.page');
Route::post('login', [AuthentificationController::class, 'store'])->name('login');

Route::get('/forgot-password', [AuthentificationController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/forgot-password', [AuthentificationController::class, 'forgotPasswordPost'])->name('forgot');
Route::get('/reset-password/{token}', [AuthentificationController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-password', [AuthentificationController::class, 'resetPasswordPost'])->name('reset');

Route::get('/check-your-email', [AuthentificationController::class, 'waitPage'])->name('waitPage');
Route::post('logout', [AuthentificationController::class, 'destroy'])->name('logout');


Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('courses', [DashboardController::class, 'course'])->name('admin.course');


Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);
Route::resource('parents', ParentController::class);
Route::get('/search-parents', [ParentController::class, 'search'])->name('search.parents');




Route::group(['prefix' => 'classes'], function () {
    Route::get('/', [ClasseController::class, 'index'])->name('admin.class');
    Route::post('/', [ClasseController::class, 'store'])->name('create.class');
    Route::delete('/{id}', [ClasseController::class, 'destroy'])->name('delete.class');
    Route::put('/', [ClasseController::class, 'update'])->name('update.class');
});


Route::group(['middleware' => ['auth', 'role:parent']], function () {
});
