<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            "success" => 200,
            "data" => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|min:3',
            'user_id' => 'required', //quem coloca é o middleware
            'content' => 'nullable'
        ]);


        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'user_id' => $validated['user_id']
        ]);


        return redirect()->route('posts.create')->with('success', 'Posts criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        $post->clicked = $post->clicked + 1;
        $post->save();
        $data = [
            'post' => $post,
        ];
        return view('posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'user_id' => 'required', //quem coloca é o middleware
            'content' => 'nullable'
        ]);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'user_id' => $validated['user_id']
        ]);

        return redirect()->route('posts.show', ['post' => $post])->with('success', 'Post atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('welcome')->with('success', 'Post deletado com sucesso.');
    }
}
