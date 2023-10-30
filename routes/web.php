<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPagesController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Livewire\Profile\UpdateDoctorProfile;

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

Route::get('/', [MainPagesController::class, 'showHomepage'])->name('home');
Route::get('appointment', [MainPagesController::class, 'showBookingPage'])->name('search.doctors');
Route::get('appointment/channel', [MainPagesController::class, 'showBookingForm'])->name('booking.form');
Route::post('appointment/channel', [MainPagesController::class, 'channelAppointment'])->name('booking.channel');
Route::get('success/{ref}', [MainPagesController::class, 'success'])->name('success');


Route::group(['middleware' => ['auth', 'verified']], function() {

    Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

    // Middleware restricting access otherthan to Admin role
    Route::group(['middleware' => ['role:Admin']], function () {

        // Doctor Managing
        Route::resource('doctors', DoctorController::class);
        Route::get('doctors/schedule/{user_id}', UpdateDoctorProfile::class)->name('doctor.schedule-edit');

        // Managing Users
        Route::resource('manage/users', UserController::class);

        Route::get('admin-appointments', [AppointmentController::class, 'viewAppointmentsAdmin'])->name('admin.appointments.all');

    });


    // Middleware restricting access otherthan to Doctor role
    Route::group(['middleware' => ['role:Doctor']], function () {


        // Appointment Management - Doctor
        Route::resource('appointments', AppointmentController::class);
        Route::get('appointments/view/{id}', [AppointmentController::class, 'viewIndAppointment'])->name('appointments.type-ind');

    });


});
