<?php

namespace App\Providers;

use App\BasicFacade\BasicModule;
use App\BasicFacade\UpdateCourseStudentReport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Log;

class BasicModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // App::bind('BasicModule', function()
        // {
        //     //return new App\BasicFacade\BasicMethod;
        //     return new BasicModule;
        // });
        App::bind('UpdateCourseStudentReport', function()
        {
            //return new App\BasicFacade\BasicMethod;
            return new UpdateCourseStudentReport;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
