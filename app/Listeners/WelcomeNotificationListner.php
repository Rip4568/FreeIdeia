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
            'title' => 'Saudações!',
            'message' => 'Bem-vindo(a) ' . $event->user->name . '! Sua conta foi criada com sucesso.'
        ]);

        Notification::create([
            'user_id' => $event->user->id,
            'title' => 'Regras da plataforma',
            'message' => '1) Evite expor pessoas desnecessariamente, <br> 2) se divirta'
        ]);

        Notification::create([
            'user_id' => $event->user->id,
            'title' => 'Jonathas lhe agradece!',
            'message' => 'Como fundador da plataforma desejo a você que se divirta e agradeço por ter se cadastrado!'
        ]);
    }
}
