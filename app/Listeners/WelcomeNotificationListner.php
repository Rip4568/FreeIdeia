<?php

namespace App\Listeners;

use App\Events\WelcomeNotificationEvent;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WelcomeNotificationListner implements ShouldQueue
{
    use InteractsWithQueue;

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
    public function handle(WelcomeNotificationEvent $event): void
    {
        Notification::create([
            'user_id' => $event->user->id,
            'message' => 'Bem-vindo(a) ' . $event->user->name . '! Sua conta foi criada com sucesso.'
        ]);
    }
}
