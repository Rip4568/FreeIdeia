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
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
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
        ?String $title, 
        ?String $message, 
        ?String $type
    )
    {
        $this->user = $user;
        $this->title = $title ?? 'New Notification';
        $this->message = $message ?? '';
        $this->type = $type ?? 'primary';;
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
}
