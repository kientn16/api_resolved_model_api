<?php

namespace App\Providers;

use App\Http\Controllers\Auth\LoginController;
use App\Repositories\Eloquents\BannerImageRepository;
use App\Services\BackendApiService;

class AppServiceProvider extends ServiceProvider
{

    protected $bannerImageRepository;
    protected $showAlertBeforeMaintenance = false;
    protected $maintenanceDiffInMin = 999;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('BackendApiService', function () {
            return new BackendApiService();
        });


    }
}
