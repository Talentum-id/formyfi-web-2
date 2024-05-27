<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route
        ::get('/redirect/{provider}', [SocialiteController::class, 'redirect'])
        ->where(['provider' => 'twitter|discord']);

    Route
        ::get('/callback/{provider}', [SocialiteController::class, 'callback'])
        ->where(['provider' => 'twitter|discord']);
});
