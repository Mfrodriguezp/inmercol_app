<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\RedirectionAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ProjectController;



Route::get('manager', [HomeController::class, 'index'])->name('index.manager');

//Rutas Resource para administración de usuarios y permisos.
Route::resource('projects', ProjectController::class)->names('manager.projects');