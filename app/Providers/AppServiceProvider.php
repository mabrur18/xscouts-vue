<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
		view()->composer('*', function ($view)
        {
            
			$user = request()->user();
			$view->with('user', $user);

			$layout = "layouts.app";
			if(request()->ajax()){
				$layout = "layouts.ajax";
			}
			$view->with('layout', $layout);


			$show_header = request()->show_header ?? true;
			$show_footer = request()->show_footer ?? true;
			$show_pagination = request()->show_pagination ?? true;

			$view->with('show_header', $show_header);
			$view->with('show_footer', $show_footer);
			$view->with('show_pagination', $show_pagination);

        });
    }
}
