<?php

namespace App\Http\Models;

use App\User;
use marcusvbda\vstack\Models\DefaultModel;

class Pixel extends DefaultModel
{
    protected $table = 'pixels';

    public $appends = ['code'];

    public static function hasTenant()
    {
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
