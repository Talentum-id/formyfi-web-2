<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SocialVerificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route
        ::get('/redirect/{provider}', [SocialiteController::class, 'redirect'])
        ->where(['provider' => 'twitter|discord']);
    Route
        ::get('/callback/{provider}', [SocialiteController::class, 'callback'])
        ->where(['provider' => 'twitter|discord']);
});
Route
    ::post('/social-verification/{provider}', [SocialVerificationController::class, 'verify'])
    ->where(['provider' => 'twitter|discord']);
Route::post('/upload-images', [FileController::class, 'uploadImages']);
Route::post('/upload-old-files', [FileController::class, 'uploadOldFiles']);
Route::post('/upload-docs', [FileController::class, 'uploadDocuments']);
Route::post('/delete-files', [FileController::class, 'deleteFiles']);
Route::post('/responses/dispatch', [ResponseController::class, 'dispatch']);
