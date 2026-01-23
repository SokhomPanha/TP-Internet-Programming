<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Task;
use App\Policies\TaskPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
        Gate::define('users.manage', fn($user) => $user->hasPermission('users.manage'));
        Gate::define('projects.create', fn($user) => $user->hasPermission('projects.create'));
        Gate::define('projects.update', fn($user) => $user->hasPermission('projects.update'));
        Gate::define('projects.delete', fn($user) => $user->hasPermission('projects.delete'));
        Gate::define('tasks.create', fn($user) => $user->hasPermission('tasks.create'));
        Gate::define('tasks.update', fn($user) => $user->hasPermission('tasks.update'));
        Gate::define('tasks.delete', fn($user) => $user->hasPermission('tasks.delete'));

    }
}
