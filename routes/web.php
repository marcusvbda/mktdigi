<?php


Route::get('', function () {
	return redirect("/admin");
});

require "partials/short-url.php";
require "partials/auth.php";
Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => "admin"], function () {
		require "partials/dashboard.php";
	});
});


http://local.diwe.pdc-admin-service/4LDXQ5