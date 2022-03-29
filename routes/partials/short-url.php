<?php

use App\Http\Controllers\ShortUrlController;

Route::get('{code}', [ShortUrlController::class, 'redirectTo']);
