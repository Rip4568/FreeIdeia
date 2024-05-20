<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Models\Notification;
use Database\Factories\NotificationFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListner implements ShouldQueue
{

  /**
   * The name of the connection the job should be sent to.
   *
   * @var string|null
   */

  public $conection = 'redis';

  /**
   * The name of the queue the job should be sent to.
   *
   * @var string|null
   */

  public $queue = 'listeners';

  /**
   * The time (seconds) before the job should be processed.
   *
   * @var int
   */
  public $delay = 3;

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
    $this->delay = 10;
    Notification::create([
      'user_id' => $event->user->id,
      'type' => 'primary',
      'title' => 'test test',
    ]);
  }
}
