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
use App\Http\Controllers\Admin\EnvironmentalController;

Route::get('index', [HomeController::class, 'index'])->name('index.admin');

//Rutas Resource para administración de usuarios y permisos.
Route::resource('users', UserController::class)->names('admin.users')->only(['index','store','update','destroy']);

//Rutas Resource para Proyectos
Route::group(['prefix' => 'projects'], function () {
    Route::get('/', [ProjectController::class, 'index'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.projects.index')])
    ->name('admin.projects.index');
    Route::post('store', [ProjectController::class, 'store'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.projects.create')])
    ->name('admin.projects.store');
    Route::post('update', [ProjectController::class, 'update'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.projects.edit')])
    ->name('admin.projects.update');
    Route::get('destroy/{project?}', [ProjectController::class, 'destroy'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.projects.destroy')])
    ->name('admin.projects.destroy');
});

//Rutas para Jueces
Route::group(['prefix' => 'judges'], function () {
    Route::get('/', [JudgeController::class, 'index'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.judges.index')])
    ->name('admin.judges.index');
    Route::post('store', [JudgeController::class, 'store'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.judges.create')])
    ->name('admin.judges.store');
    Route::post('update', [JudgeController::class, 'update'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.judges.edit')])
    ->name('admin.judges.update');
    Route::get('destroy/{judge?}', [JudgeController::class, 'destroy'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.judges.destroy')])
    ->name('admin.judges.destroy');
});
//Rutas para evaluaciones
Route::group(['prefix' => 'evaluateds'], function () {
    Route::get('/', [EvaluatedController::class, 'index'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.evaluateds.index')])
    ->name('admin.evaluateds.index');
    Route::post('store', [EvaluatedController::class, 'store'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.evaluateds.create')])
    ->name('admin.evaluateds.store');
    Route::post('update', [EvaluatedController::class, 'update'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.evaluateds.edit')])
    ->name('admin.evaluateds.update');
    Route::get('destroy/{evaluated?}', [EvaluatedController::class, 'destroy'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.evaluateds.destroy')])
    ->name('admin.evaluateds.destroy');
});
//Rutas para reportes
Route::group([
    'prefix' => 'reports',
    'middleware' => [\Illuminate\Auth\Middleware\Authorize::using('admin.reports.index')]
], function () {
    Route::get('/', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('{testIdentified}/{dataOption}',[ReportController::class,'getReport'])->name('admin.reports.getReport');
});
//Rutas para juicios
Route::group([
    'prefix' => 'judments',
    'middleware' => [\Illuminate\Auth\Middleware\Authorize::using('admin.judments.index')]
], function () {
    Route::get('', [JudmentController::class, 'index'])->name('admin.judments.index');
    Route::get('judment/{control?}/{carrier?}/{judges?}/{idEvaluated?}', [JudmentController::class, 'judment'])
        ->name('admin.judments.judment');
    Route::post('saveJudment', [JudmentController::class, 'saveJudment'])->name('admin.judments.saveJudment');
});

Route::group(['prefix'=>'environmentals'],function(){
    Route::get('/',[EnvironmentalController::class,'index'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.environmentals.index')])
    ->name('admin.environmentals.index');
    Route::post('store', [EnvironmentalController::class, 'store'])
    ->middleware([\Illuminate\Auth\Middleware\Authorize::using('admin.environmentals.create')])
    ->name('admin.evaluateds.store');
});