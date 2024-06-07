<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Models\Notification;
use Database\Factories\NotificationFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListener implements ShouldQueue
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
  public function handle(NotificationEvent $event): void
  {
    Notification::create([
      'user_id' => $event->user->id,
      'type' => $event->type,
      'title' => $event->title,
      'message' => $event->message
    ]);
    /* broadcast(new NotificationEvent($event->user, $event->title, $event->message, $event->type)); */
  }
}
