<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;
use App\Channels\DatabaseChannel;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// 
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Schema::defaultStringLength(191);
		$this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel());
		// $this->app->instance(BaseNotification::class, new ExampleNotification());

		$this->loadMigrationsFrom(base_path('database/migrations'), 'migrations');
	}
}
