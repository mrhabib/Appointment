<?php
use Core\Route;

use App\Controllers\AppointmentController;

Route::get('',AppointmentController::class, 'index');
Route::get('appointments',AppointmentController::class, 'index');
Route::get('appointments/:timeId/:date/reserve',AppointmentController::class, 'reserve');
