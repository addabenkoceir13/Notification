<?php

namespace App\Listeners;

use App\Events\PostCreatedEvent;
use App\Models\User;
use App\Notifications\PostCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class SendPostCreatedNotificationListener
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
    public function handle(PostCreatedEvent $event): void
    {
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new PostCreatedNotification($event->post));
    }
}
