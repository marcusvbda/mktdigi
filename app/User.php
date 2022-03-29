<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use marcusvbda\vstack\Models\Traits\hasCode;

class User extends Authenticatable
{
	use SoftDeletes, Notifiable, hasCode;

	public $guarded = ['created_at'];
	protected $dates = ['deleted_at'];
	protected $appends = ['code'];
	protected $hashPassword = false;
	public  $casts = [
		"data" => "json",
	];

	public function hasRole($role)
	{
		$roles = is_array($role) ? $role : [$role];
		return in_array($this->role, $roles);
	}

	public function can($ability, $arguments = [])
	{
		$roles = config("roles", []);
		$permissions = data_get($roles, $this->role . ".permissions", []);
		foreach ($permissions as $permission) {
			if (data_get($permission, 0) === $ability) {
				return true;
			}
		}
		return false;
	}
}
