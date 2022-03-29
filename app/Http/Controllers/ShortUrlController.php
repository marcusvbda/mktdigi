<?php

namespace App\Http\Controllers;

use App\Http\Models\ShortUrl;

class ShortUrlController extends Controller
{
    public function redirectTo($code)
    {
        $url = ShortUrl::findByCodeOrFail($code);
        if (!$url->canShow()) {
            abort(404);
        }
        $url->dispatchPixelEvents();
        $url->increment('clicks');
        // dd('passow');
        return redirect($url->original_url);
    }
}
