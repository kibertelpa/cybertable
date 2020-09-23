<?php

namespace Kibertelpa\Cybertable\Providers;

use Illuminate\Support\ServiceProvider;

class CybertableServiceProvider extends ServiceProvider {
	
	public function boot() {
		$this->loadViewsFrom(__DIR__.'/../views', 'cybertable');
	}
	
	public function register() {
		
	}
	
}