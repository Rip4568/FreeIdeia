<?php

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
{
    /**
     * Determinar se o usuário pode visualizar quaisquer modelos.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     /* Determinar se o usuário pode visualizar o modelo. */
     /*/
    public function view(User $user, Notification $notification): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notification $notification): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notification $notification): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Notification $notification): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Notification $notification): bool
    {
        return true;
    }
}
