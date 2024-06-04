<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();
        Broadcast::channel('notification-user.{id}', function ($user, $id) {
            return (int) $user->id === (int) $id;
        });

        require base_path('routes/channels.php');
    }
}
