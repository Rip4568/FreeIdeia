<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user) {
        if (Auth::user()->id === $user->id) {
            return redirect()->back()->withErrors('Você não pode seguir a si mesmo.');
        }
        Auth::user()->following()->attach($user->id);
        // Lógica adicional, se necessário
        return redirect()->back();
    }

    public function unfollow(User $user) {
        if (!Auth::user()->following->contains($user->id)) {
            return redirect()->back()->withErrors('Você não está seguindo este usuário.');
        }
        Auth::user()->following()->detach($user->id);
        // lógica adicional, se necessário
        return redirect()->back();
    }
}
