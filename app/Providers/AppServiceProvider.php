<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use TCG\Voyager\Http\Controllers\VoyagerBaseController as VoyagerBaseController;
use App\Http\Controllers\Admin\Core\VoyagerBaseController as LocalBaseController;

use TCG\Voyager\Http\Controllers\VoyagerMediaController as VoyagerMediaController;
use App\Http\Controllers\Admin\Core\VoyagerMediaController as LocalMediaController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VoyagerBaseController::class, LocalBaseController::class);
        $this->app->bind(VoyagerMediaController::class, LocalMediaController::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
