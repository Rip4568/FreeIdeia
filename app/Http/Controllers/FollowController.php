<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Follow a user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow(User $user)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->id === $user->id) {
            return redirect()->back()->withErrors('Você não pode seguir a si mesmo.');
        }
        $authenticatedUser->following()->attach($user->id);
        return redirect()->back();
    }

    /**
     * Unfollow a user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unfollow(User $user)
    {
        $authenticatedUser = Auth::user();
        if (!$authenticatedUser->following->contains($user)) {
            return redirect()->back()->withErrors('Você não está seguindo este usuário.');
        }
        $authenticatedUser->following()->detach($user);
        return redirect()->back();
    }
}
