<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\RedirectionAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;



Route::get('admin', [HomeController::class, 'index'])->name('index.admin');

//Rutas Resource para administración de usuarios y permisos.
Route::resource('users', UserController::class)->names('admin.users');
