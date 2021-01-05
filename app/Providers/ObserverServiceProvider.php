<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\User::observe(\App\Observers\UserObserver::class);
        \App\Employee::observe(\App\Observers\EmployeeObserver::class);
        \App\Employment::observe(\App\Observers\EmploymentObserver::class);
        \App\Leave::observe(\App\Observers\LeaveObserver::class);
        // NOT WORKING IDK WHY
        // \App\File::observe(\App\Observers\FileObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
