<?php

namespace App\Providers;


use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use  \App\Listeners\app\Listeners\Login\RestoreCartItems;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        //la clase evento  login, se ejecuta automaticamente cuando un usuario se loguea
       Login::class => [
            //al ejecutar el evento login, se ejecuta las clases oyentes de de ese evento RestoreCartItems.php
            //creo la clase app/Listeners/RestoreCartItems.php utilizando el comando php artisan event:generate
            // \app\Listeners\Login\RestoreCartItems::class
            RestoreCartItems::class

        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // aca se registran los Observadores y los listeners
        \App\Models\Cover::observe(\App\Observers\CoverObserver::class);


    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
