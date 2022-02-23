<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;

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
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('Main')
            ->addPermission('palaces', 'Palace');

        $dashboard->registerPermissions($permissions);
    }
}
