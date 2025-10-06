<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\UserCreatedEvent::class => [
            \App\Listeners\SendUserCreatedNotificationListener::class,
        ],
        \App\Events\UserApprovedEvent::class => [
            \App\Listeners\SendUserApprovedNotificationListener::class,
        ],
        \App\Events\PostCreatedEvent::class => [
            \App\Listeners\SendPostCreatedNotificationListener::class,
        ],
        \App\Events\PostApprovedEvent::class => [
            \App\Listeners\SendPostApprovedNotificationListener::class,
        ],
    ];

    public function boot(): void {}
}
