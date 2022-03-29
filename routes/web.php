<?php


Route::get('', function () {
	return redirect("/admin");
});

require "partials/auth.php";
Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => "admin"], function () {
		require "partials/dashboard.php";
	});
});
