<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AddUserIdToRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar se o usuário está autenticado
        if (Auth::check()) {
            // Adicionar o user_id ao corpo da requisição
            $request->merge(['user_id' => Auth::id()]);
        } else {
            $request->merge(['user_id' => null]);
        }

        return $next($request);
    }
}
