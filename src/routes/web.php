<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreakTimeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

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

Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'show']);
    Route::get('/attendance', [AttendanceController::class, 'showTable']);
    Route::get('/attendance/previous', [AttendanceController::class, 'showTablePreviousDay']);
    Route::get('/attendance/next', [AttendanceController::class, 'showTableNextDay']);
    Route::post('/work_start', [AttendanceController::class, 'workStartRecord']);
    Route::post('/work_end', [AttendanceController::class, 'workEndRecord']);
    Route::post('/break_start', [BreakTimeController::class, 'breakStartRecord']);
    Route::post('/break_end', [BreakTimeController::class, 'breakEndRecord']);
    Route::get('/users', [UserController::class, 'showUserList']);
    Route::get('/users/attendance', [UserController::class, 'showUserAttendance']);
});