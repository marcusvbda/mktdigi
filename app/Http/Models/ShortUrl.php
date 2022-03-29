<?php

namespace App\Http\Models;

use App\Http\Models\Scopes\OrderByScope;
use App\User;
use marcusvbda\vstack\Models\DefaultModel;
use marcusvbda\vstack\Models\Observers\UserObserver;
use marcusvbda\vstack\Models\Scopes\UserScope;
use marcusvbda\vstack\Vstack;

class ShortUrl extends DefaultModel
{
    protected $table = 'short_urls';

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
        return Vstack::makeLinesHtmlAppend($this->name, $this->short_url);
    }

    public function pixels()
    {
        return $this->belongsToMany(Pixel::class);
    }

    public function getShortUrlAttribute()
    {
        $url = config("app.url");
        return $url . "/" . $this->code;
    }
}
