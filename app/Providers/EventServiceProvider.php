<?php

namespace App\Providers;

use App\Listeners\AssignClientRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AssignClientRole::class,
        ],
        'App\Events\PersonExcelImported' => [
            'App\Listeners\ProcessPersonExcel',
        ],
        'App\Events\SharedPersonExcelImported' => [
            'App\Listeners\ProcessSharedPersonExcel',
        ],
        'App\Events\PalaceDescriptionExcelImported' => [
            'App\Listeners\ProcessPalaceDescriptionExcel',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
