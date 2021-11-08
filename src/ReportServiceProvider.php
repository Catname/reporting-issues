<?php

namespace Catname\ReportingIssues;

//use App\Handlers\reportIssues;


class ReportServiceProvider extends \Illuminate\Support\ServiceProvider
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
            __DIR__.'/config/reportissue.php' => config_path('reportissue.php'),
        ], 'config');
    }

    public function provides()
    {
        return [reportIssues::class, 'reportissue'];
    }
}
