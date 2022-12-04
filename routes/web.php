<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\TimetableController;
use App\Http\Controllers\Teacher\TimetableController as TeacherTimetableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:1')
        ->prefix('student')
        ->name('student.')
        ->group(function () {
            Route::get('timetable', [TimetableController::class, 'index'])
                ->name('timetable');
        });

    Route::middleware('role:2')
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {
            Route::get('timetable', [TeacherTimetableController::class, 'index'])
                ->name('timetable');
        });

    Route::middleware('role:3')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('users', [UsersController::class, 'index'])
                ->name('users');
        });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
