<?php


Artisan::command('logs:clear', function () {
	array_map('unlink', array_filter((array) glob(storage_path('logs/*.log'))));
	$this->comment('Logs have been cleared!');
})->describe('Clear log files');
