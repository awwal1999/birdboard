<?php

namespace App\Providers;

use App\Task;
use App\Project;
use App\Observers\TaskObserver;
use App\Observers\ProjectObserver;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        Task::observe(TaskObserver::class);
        Project::observe(ProjectObserver::class);
    }
}
