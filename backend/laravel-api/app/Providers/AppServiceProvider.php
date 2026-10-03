<?php

namespace App\Providers;

use App\Models\Story;
use App\Policies\StoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Story::class, StoryPolicy::class);

        Gate::define('view-parent-dashboard', function ($user) {
            return in_array($user->role, ['parent', 'admin'], true);
        });
    }
}
