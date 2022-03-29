<?php

use App\Http\Controllers\ShortUrlController;

Route::group(['prefix' => "short"], function () {
    Route::get('{code}', [ShortUrlController::class, 'redirectTo']);
});
