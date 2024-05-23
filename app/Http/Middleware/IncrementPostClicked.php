<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncrementPostClicked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->post->id);
        return $next($request);
    }

    /* executar apos o request */
    public function terminate(Request $request, Response $response)
    {
        $post = Post::find($request->post->id);
        $post->clicked = $post->clicked + 1;
        $post->save();
    }
}
