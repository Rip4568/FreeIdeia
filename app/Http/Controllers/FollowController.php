<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    
    public function follow(User $user)
    {
        $authenticatedUser = session('authenticated_user');
        if ($authenticatedUser->id === $user->id) {
            return redirect()->back()->withErrors('Você não pode seguir a si mesmo.');
        }
        $authenticatedUser->following()->attach($user->id);
        // Lógica adicional, se necessário
        return redirect()->back();
    }

    public function unfollow(User $user)
    {
        $authenticatedUser = session('authenticated_user');
        if (!$authenticatedUser->following->contains($user->id)) {
            return redirect()->back()->withErrors('Você não está seguindo este usuário.');
        }
        $authenticatedUser->following()->detach($user->id);
        // lógica adicional, se necessário
        return redirect()->back();
    }
}
