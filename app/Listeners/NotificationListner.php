<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Models\Notification;
use Database\Factories\NotificationFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListner implements ShouldQueue
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
  public function handle(NotificationEvent $event): void
  {
    Notification::create([
      'user_id' => $event->user->id,
      'type' => 'primary',
      'title' => 'test test',
    ]);
  }

}
