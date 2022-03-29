<?php

namespace App\Http\Controllers;

use App\Http\Models\ShortUrl;
use Browser;

class ShortUrlController extends Controller
{
    public function redirectTo($code)
    {
        $url = ShortUrl::findByCodeOrFail($code);
        if (!$url->canShow()) {
            abort(404);
        }
        $url->incrementClick();
        return view("redirect_page", compact("url"));
    }
}
