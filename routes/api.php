<?php

use Illuminate\Support\Facades\Route;

Route::get('/alarms', [\App\Http\Controllers\Api\AlarmController::class, 'index']);
Route::get('/alarms/{alarm}', [\App\Http\Controllers\Api\AlarmController::class, 'show']);
Route::post('/alarms', [\App\Http\Controllers\Api\AlarmController::class, 'store']);
Route::put('/alarms/{alarm}', [\App\Http\Controllers\Api\AlarmController::class, 'update']);
Route::delete('/alarms/{alarm}', [\App\Http\Controllers\Api\AlarmController::class, 'destroy']);

Route::get('/alarms-types', [\App\Http\Controllers\Api\AlarmTypeController::class, 'index']);
Route::get('/alarms-types/{alarmType}', [\App\Http\Controllers\Api\AlarmTypeController::class, 'show']);
Route::post('/alarms-types', [\App\Http\Controllers\Api\AlarmTypeController::class, 'store']);
Route::put('/alarms-types/{alarmType}', [\App\Http\Controllers\Api\AlarmTypeController::class, 'update']);
Route::delete('/alarms-types/{alarmType}', [\App\Http\Controllers\Api\AlarmTypeController::class, 'destroy']);
