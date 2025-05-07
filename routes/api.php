<?php

use Illuminate\Support\Facades\Route;

Route::get('/alarms', [\App\Http\Controllers\Api\AlarmController::class, 'index']);
Route::get('/alarms/{alarm}', [\App\Http\Controllers\Api\AlarmController::class, 'show']);
Route::post('/alarms', [\App\Http\Controllers\Api\AlarmController::class, 'store']);

Route::get('/alarms-types', [\App\Http\Controllers\Api\AlarmTypeController::class, 'index']);
Route::get('/alarms-types/{alarmType}', [\App\Http\Controllers\Api\AlarmTypeController::class, 'show']);
Route::post('/alarms-types', [\App\Http\Controllers\Api\AlarmTypeController::class, 'store']);
