<?php

namespace App\Http\Models;

use marcusvbda\vstack\Models\DefaultModel;
use App\Http\Models\Scopes\{OrderByScope};

class Lead extends DefaultModel
{
	public $resource_id = "leads";
	protected $table = "leads";
	public $casts = [
		"data" => "object"
	];

	public $appends = ["code"];


	public static function boot()
	{
		parent::boot();
		static::addGlobalScope(new OrderByScope(with(new static)->getTable()));
	}
}
