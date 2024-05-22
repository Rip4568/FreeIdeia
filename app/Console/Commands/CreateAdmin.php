<?php

namespace App\Console\Commands;

use App\Events\NotificationEvent;
use App\Listeners\NotificationListner;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Qual é o seu nome?');
        $email = $this->ask('Qual é o seu email?');
        $password = $this->secret('Digite a senha');
        $password_confirmation = $this->secret('Confirme sua senha ...');

        if ($password !== $password_confirmation) {
            $this->error('As senhas digitadas não conferem!');
            return;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'is_admin' => true,
            'password' => Hash::make($password),
        ]);

        $user->is_admin = true;
        $user->save();

        NotificationEvent::dispatch($user);

        $this->info('Admin created' . PHP_EOL . 'Email: ' . $email . PHP_EOL . 'Password: ' . $password);
    }
}
