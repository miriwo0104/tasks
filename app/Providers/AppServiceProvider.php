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
        $this->app->bind(
            \App\Repositories\WorkspaceRepositoryInterface::class,
            \App\Repositories\WorkspaceRepository::class
        );

        $this->app->bind(
            \App\Repositories\LimitRepositoryInterface::class,
            \App\Repositories\LimitRepository::class
        );

        $this->app->bind(
            \App\Repositories\TaskRepositoryInterface::class,
            \App\Repositories\TaskRepository::class
        );

        $this->app->bind(
            \App\Repositories\MemoRepositoryInterface::class,
            \App\Repositories\MemoRepository::class
        );
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
