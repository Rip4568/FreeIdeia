<?php

namespace App\Console\Commands;

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
        User::create([
            'name' => 'admin',
            'email' => 'admin@hotmail.com',
            'password' => Hash::make('admin'),
        ]);

        $this->info('Admin created');
    }
}
