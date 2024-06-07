<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search') ?? null;
        $posts = Post::when($search, function ($query) use ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . strtolower($search) . '%')
                    ->orWhere('title', 'like', '%' . strtoupper($search) . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        })->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(12);

        $following_users = auth()->user()->following;
        $data = [
            "posts" => $posts,
            "status" => 200,
            "following_users" => $following_users,
            "search" => $search,
            "user" => $user,
        ];
        return view('posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $this->authorize('create', Post::class);
        return view('posts.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        /* $this->authorize('create', Post::class); */
        $validated = $request->validated();
        $post = $this->postService->create($validated);
        return redirect()->route('posts.create')->with('success', 'Posts criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = Auth::user();
        $this->authorize('view', $post);
        $post->load('comments');
        $following_users = auth()->user()->following;
        $data = [
            'post' => $post,
            'following_users' => $following_users,
            'user' => $user,
        ];
        return view('posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $user = Auth::user();
        $this->authorize('update', $post);
        return view('posts.edit', ['post' => $post, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validated();
        $post = $this->postService->update($post->id, $validated);
        return redirect()->route('posts.show', ['post' => $post])->with('success', 'Post atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('welcome')->with('success', 'Post deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%')
            ->paginate(6);
        return view('welcome', ['posts' => $posts]);
    }
}
