<?php

namespace App\Livewire;

use App\Events\NotificationEvent;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationLivewire extends Component
{
    public $notifications;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadNotifications();
    }

    #On:{'notification.'}
    public function loadNotifications()
    {
        $this->notifications = Notification::where('user_id', $this->user->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    public function deleteNotification($notificationId)
    {
        Notification::where('id', $notificationId)->delete();
        $this->loadNotifications();
    }

    public function clearAllNotifications()
    {
        $notifications = $this->user->notifications;
        $notifications->delete();
        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notification-livewire');
    }
}
