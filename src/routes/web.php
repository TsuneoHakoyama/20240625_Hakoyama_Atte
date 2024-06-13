<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreakTimeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/', [AttendanceController::class, 'show']);
    Route::get('/attendance', [AttendanceController::class, 'showTable']);
    Route::get('/attendance/previous', [AttendanceController::class, 'showTablePreviousDay']);
    Route::get('/attendance/next', [AttendanceController::class, 'showTableNextDay']);
    Route::post('/work-start', [AttendanceController::class, 'workStartRecord']);
    Route::post('/work-end', [AttendanceController::class, 'workEndRecord']);
    Route::post('/break-start', [BreakTimeController::class, 'breakStartRecord']);
    Route::post('/break-end', [BreakTimeController::class, 'breakEndRecord']);
    Route::get('/users', [UserController::class, 'showUserList']);
    Route::get('/users/attendance', [UserController::class, 'showUserAttendance']);
});