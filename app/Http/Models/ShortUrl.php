<?php

namespace App\Http\Models;

use App\Http\Models\Scopes\OrderByScope;
use App\User;
use Carbon\Carbon;
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

    public function getUrlBadgeAttribute()
    {
        return "<copy-text value='" . $this->short_url . "'></copy-text>";
    }

    public function getLabelAttribute()
    {
        return Vstack::makeLinesHtmlAppend($this->name, $this->original_url);
    }

    public function pixels()
    {
        return $this->belongsToMany(Pixel::class);
    }

    public function getShortUrlAttribute()
    {
        $url = config("app.url");
        return $url . "/short/" . $this->code;
    }

    public function getIsDateExpiredAttribute()
    {
        if (!$this->due_date) {
            return false;
        }
        $due_date = Carbon::parse($this->due_date);
        return Carbon::now()->gt($due_date);
    }

    public function canShow()
    {
        if ($this->is_date_expired) {
            return false;
        }
        return true;
    }

    public function getFDueDateAttribute()
    {
        if (!$this->due_date) {
            return null;
        }
        return Carbon::parse($this->due_date)->format('d/m/Y');
    }

    public function clicks()
    {
        return $this->hasMany(ShortUrlClick::class, 'short_url_id');
    }

    public function incrementClick()
    {
        $this->clicks()->create([
            "data" => []
        ]);
    }
}
