<?php

namespace App\Listeners;

use App\Events\PostApprovedEvent;
use App\Notifications\PostApprovedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostApprovedNotificationListener
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
    public function handle(PostApprovedEvent $event): void
    {
        $event->post->user->notify(new PostApprovedNotification($event->post));
    }
}
