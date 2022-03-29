<?php

return [
	"default_upload_route" => "/admin/upload",
	"resource_export_extension" => "xlsx",
	"extra_javascript_global_variables" => [],
	"socket_service" => [
		"uri" => env("SOCKET_SERVER"),
		"username" => env("SOCKET_USERNAME"),
		"password" => env("SOCKET_PASSWORD"),
		"uid" => env("SOCKET_UID"),
	],
	"api" => [
		"token_expiration" => "1 hour",
	],
	"animation" => [
		"enabled" => false,
	],
];
