<?php

namespace App\Console\Commands;

use App\Events\NotificationEvent;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;

use function Termwind\ask;

class NotificateAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notificateAllUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando ira notificar todos os usuarios cadastrados no sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = $this->ask('Qual o título da notificação?', 'default_title');
        $message = $this->ask('Qual o conteúdo da notificação?', 'default_message');
        $type = $this->choice('Qual o tipo da notificação?', ['success', 'error', 'danger', 'primary', 'secondary'], 'primary');

        foreach (User::all() as $user) {
            event(new NotificationEvent($user, $title, $message, $type));
        }
    }
}