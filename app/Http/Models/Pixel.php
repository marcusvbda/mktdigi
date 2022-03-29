<?php

namespace App\Http\Models;

use App\Http\Models\Scopes\OrderByScope;
use App\User;
use marcusvbda\vstack\Models\DefaultModel;
use marcusvbda\vstack\Models\Observers\UserObserver;
use marcusvbda\vstack\Models\Scopes\UserScope;
use marcusvbda\vstack\Vstack;

class Pixel extends DefaultModel
{
    protected $table = 'pixels';

    public $appends = ['code'];

    public static function boot()
    {
        parent::boot();
        static::observe(new UserObserver());
        static::addGlobalScope(new OrderByScope(with(new static)->getTable()));
        static::addGlobalScope(new UserScope());
    }

    public static function hasTenant()
    {
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLabelAttribute()
    {
        return Vstack::makeLinesHtmlAppend($this->name, $this->value);
    }
}
