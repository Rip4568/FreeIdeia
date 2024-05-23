<?php

namespace App\Listeners;

use App\Events\WelcomeNotificationEvent;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
        try {
            $n1 = Notification::create([
            'user_id' => $event->user->id,
            'title' => 'Saudações!',
            'message' => 'Bem-vindo(a) ' . $event->user->name . '! Sua conta foi criada com sucesso.'
        ]);

        $n2 = Notification::create([
            'user_id' => $event->user->id,
            'title' => 'Regras da plataforma',
            'message' => '1) Evite expor pessoas desnecessariamente, <br> 2) se divirta'
        ]);

        $n3 = Notification::create([
            'user_id' => $event->user->id,
            'title' => 'Jonathas lhe agradece!',
            'message' => 'Como fundador da plataforma desejo a você que se divirta e agradeço por ter se cadastrado!'
        ]);

        Log::info('n1: ' . $n1 . 'n2: ' . $n2 . 'n3: ' . $n3);
        } catch (\Exception $e) {
            Log::error('Error creating notifications: ' . $e->getMessage());
        }
    }
}
