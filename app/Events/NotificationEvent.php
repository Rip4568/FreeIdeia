<?php

namespace App\Events;

use App\Models\Notification;
use App\Models\User;
use Dotenv\Util\Str;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public String $title;
    public String $message;
    public String $type;

    /**
     * Create a new event instance.
     */
    public function __construct(
        User $user,
        String $title = 'New Notification',
        String $message = '',
        String $type = 'primary'
    ) {
        $this->user = $user;
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('notifications.' . $this->user->id),
        ];
    }

    public function brodacastWith()
    {
        return [
            new NotificationEvent($this->user, $this->title, $this->message, $this->type),
        ];
    }
}
