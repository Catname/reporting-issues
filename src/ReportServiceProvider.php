<?php

namespace Catname\ReportingIssues;

//use App\Handlers\reportIssues;
use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{

    protected $defer = true;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(reportIssues::class, function(){
            return new reportIssues();
        });

        $this->app->alias(reportIssues::class, 'reportissue');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/reportissue.php' => config_path('reportissue.php'),
        ], 'config');
    }

    public function provides()
    {
        return [reportIssues::class, 'reportissue'];
    }
}