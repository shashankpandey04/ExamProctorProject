<?php

use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ResultController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/exams', [ExamController::class, 'index']);
    Route::post('/exams', [ExamController::class, 'store']);
    Route::put('/exams/{exam}', [ExamController::class, 'update']);
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);

    Route::get('/results', [ResultController::class, 'index']);
    Route::post('/results', [ResultController::class, 'store']);
});