<?php

namespace App\Listeners;

use App\Events\UserApprovedEvent;
use App\Notifications\UserApprovedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserApprovedNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserApprovedEvent $event): void
    {
        $event->user->notify(new UserApprovedNotification($event->user));
    }
}
