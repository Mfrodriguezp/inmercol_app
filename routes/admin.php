<?php

use App\Http\Controllers\Admin\EvaluatedController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JudgeController;
use App\Http\Controllers\RedirectionAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;



Route::get('admin', [HomeController::class, 'index'])->name('index.admin');

//Rutas Resource para administración de usuarios y permisos.
Route::resource('users', UserController::class)->names('admin.users');
//Rutas Resource para Proyectos
Route::resource('projects',ProjectController::class)->names('admin.projects');
//Rutas para Jueces
Route::group(['prefix'=>'judges'],function(){
    Route::get('',[JudgeController::class,'index'])->name('admin.judges.index');
    Route::post('store',[JudgeController::class,'store'])->name('admin.judges.store');
    Route::post('update',[JudgeController::class,'update'])->name('admin.judges.update');
    Route::get('destroy/{judge?}',[JudgeController::class,'destroy'])->name('admin.judges.destroy');
});
//Rutas para evaluaciones
Route::group(['prefix'=>'evaluateds'],function(){
    Route::get('/',[EvaluatedController::class,'index'])->name('admin.evaluateds.index');
    Route::post('store',[EvaluatedController::class,'store'])->name('admin.evaluateds.store');
    Route::post('update',[EvaluatedController::class,'update'])->name('admin.evaluateds.update');
    Route::get('destroy/{evaluated?}',[EvaluatedController::class,'destroy'])->name('admin.evaluateds.destroy');
});
