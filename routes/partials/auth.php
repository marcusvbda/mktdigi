<?php

use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'signin'])->name('signin');
