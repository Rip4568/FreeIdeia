<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\search;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $postService;
    private $userService;

    public function __construct(
        PostService $postService,
        UserService $userService
        )
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        $text = $request->input('search', null);
        $userId = $request->input('user_id', null);
        $orderByColumn = $request->input('order_by_column', 'created_at');
        $orderByDirection = $request->input('order_by_direction', 'desc');

        $posts = $this->postService->index(
            with: ['user', 'comments'],
            text: $text,
            orderByColumn: $orderByColumn,
            orderByDirection: $orderByDirection
        );

        $user = Auth::user();
        $following_users = $user->following;
        $data = [
            "posts" => $posts,
            "status" => 200,
            "following_users" => $following_users,
            "search" => $text,
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
        $validated = $request->validated();
        $this->postService->create($validated);
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
        $this->postService->delete($post->id);
        return redirect()->route('welcome')->with('success', 'Post deletado com sucesso.');
    }

    public function postsByUser(Request $request, string $username)
    {
        $user = $this->userService->getBy(with: ['posts'], username: $username);
        if (!$user) {
            return redirect()->route('welcome')->with('error', 'Usuário não encontrado.');
        }
        $posts = $user->posts;
        return view('posts.index', compact('posts', 'user'));
    }
}
