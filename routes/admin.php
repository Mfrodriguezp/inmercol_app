<?php

use App\Http\Controllers\Admin\EvaluatedController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JudgeController;
use App\Http\Controllers\Admin\JudmentController;
use App\Http\Controllers\RedirectionAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;

Route::get('admin', [HomeController::class, 'index'])->name('index.admin');

//Rutas Resource para administración de usuarios y permisos.
Route::resource('users', UserController::class)->names('admin.users');

//Route::resource('projects',ProjectController::class)->names('admin.projects');
//Rutas Resource para Proyectos
Route::group(['prefix'=>'projects'],function(){
    Route::get('/',[ProjectController::class,'index'])->name('admin.projects.index');
    Route::post('store',[ProjectController::class,'store'])->name('admin.projects.store');
    Route::post('update',[ProjectController::class,'update'])->name('admin.projects.update');
    Route::get('destroy/{project?}',[ProjectController::class,'destroy'])->name('admin.projects.destroy');
});

//Rutas para Jueces
Route::group(['prefix'=>'judges'],function(){
    Route::get('/',[JudgeController::class,'index'])->name('admin.judges.index');
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
//Rutas para evaluaciones
Route::group(['prefix'=>'reports'],function(){
    Route::get('',[ReportController::class,'index'])->name('admin.reports.index');
});
Route::group(['prefix'=>'judments'],function(){
    Route::get('',[JudmentController::class,'index'])->name('admin.judments.index');
    Route::get('judment/{control?}/{carrier?}/{judges?}/{judmentNumber?}/{idEvaluated?}',[JudmentController::class,'judment'])
    ->name('admin.judments.judment');
    Route::post('saveJudment',[JudmentController::class,'saveJudment'])->name('admin.judments.saveJudment');

});