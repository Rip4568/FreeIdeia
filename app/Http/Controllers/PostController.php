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
            'user_id' => 'required' //quem coloca é o middleware
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
        return response()->json(
            [
                "status" => 200,
                "messgae" => "find an especific post",
                "data" => $post
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
