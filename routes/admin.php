<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');

Route::get('users', \App\Http\Livewire\Admin\Users\ListUsers::class)->name('users');

Route::get('appointments', \App\Http\Livewire\Admin\Appointments\ListAppointments::class)->name('appointments');
Route::get('appointments/create', \App\Http\Livewire\Admin\Appointments\CreateAppointmentForm::class)->name('appointments.create');
Route::get('appointments/{appointment}/edit', \App\Http\Livewire\Admin\Appointments\UpdateAppointmentForm::class)->name('appointments.edit');

Route::get('profile', \App\Http\Livewire\Admin\Profile\UpdateProfile::class)->name('profile.edit');

Route::get('analytics', \App\Http\Livewire\Analytics::class)->name('analytics');


