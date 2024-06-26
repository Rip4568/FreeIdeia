<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {

        $validatedData = $request->validate([
            'user_id' => 'required', //quem coloca é o middleware
            'content' => 'required|min:1',
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => $validatedData['user_id'],
            'content' => $validatedData['content']
        ]);

        return redirect()->route('posts.show', ['post' => $post]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $validatedData = $request->validate([
            'content' => 'required|min:1',
        ]);

        $comment->content = $validatedData['content'];
        $comment->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('posts.show', ['post' => $post]);
    }
}
