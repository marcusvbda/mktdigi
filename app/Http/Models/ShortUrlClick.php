<?php

namespace App\Http\Models;

use marcusvbda\vstack\Models\DefaultModel;

class ShortUrlClick extends DefaultModel
{
    protected $table = 'short_urls_clicks';

    public $appends = ['code'];
    public $casts = ['data' => 'object'];

    public static function hasTenant()
    {
        return false;
    }

    public function short_url()
    {
        return $this->belongsTo(ShortUrl::class);
    }
}
