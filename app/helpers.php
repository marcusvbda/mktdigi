<?php

if (!function_exists('hasPermissionTo')) {
	function hasPermissionTo($permission)
	{
		if (!\Auth::check()) {
			return false;
		}
		$user = \Auth::user();
		if ($user->hasRole(["super-admin"])) {
			return true;
		}
		$permission = trim($permission);
		return $user->can($permission);
	}
}


if (!function_exists('getEnabledIcon')) {
	function getEnabledIcon($enabled = false)
	{
		$icons = [
			true => '🟢',
			false => '🔴',
			'loading' => '
			<div class="loading-ballls d-flex flex-row align-items-center justify-content-center mr-2">
				<div class="spinner-grow spinner-grow-sm text-muted mr-1" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow spinner-grow-sm text-muted mr-1" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow spinner-grow-sm text-muted mr-1" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
			'
		];
		return @$icons[$enabled] ?? '🟡';
	}
}

if (!function_exists('snakeCaseToCamelCase')) {
	function snakeCaseToCamelCase($string, $capitalizeFirstCharacter = false)
	{
		$str = str_replace('-', '', ucwords($string, '-'));
		if (!$capitalizeFirstCharacter) {
			$str = lcfirst($str);
		}
		return $str;
	}
}

if (!function_exists('debug_log')) {
	function debug_log(string $path, string $message, $context = [])
	{
		@mkdir(storage_path("logs/" . $path, 0755, true));
		\Log::channel('debug')->debug("\{$path} $message", $context);
	}
}

if (!function_exists('queryBetweenDates')) {
	function queryBetweenDates($column, $dates)
	{
		return "DATE($column) >= DATE('$dates[0]') and DATE($column) <= DATE('$dates[1]')";
	}
}
