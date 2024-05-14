<?php

namespace Database\Seeders;

use App\Models\Notification;
use Database\Factories\NotificationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //para cada usuario registrado no banco de dados
        //registre 3 notificações para cada um deles
        Notification::factory(10)->create();
    }
}
