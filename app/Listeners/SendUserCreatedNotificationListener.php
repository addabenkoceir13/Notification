<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUserCreatedNotificationListener
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
    public function handle(UserCreatedEvent $event): void
    {
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new UserCreatedNotification($event->user));
    }
}
