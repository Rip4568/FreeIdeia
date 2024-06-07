<?php

namespace App\Http\Controllers;

use App\Events\WelcomeNotificationEvent;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $rememberMe = $request['remember-me'] ? true : false;

        // Tentar autenticar o usuário
        if (Auth::attempt($credentials, $rememberMe)) {
            // Login bem-sucedido, redirecionar para a página desejada
            session(['authenticated_user' => Auth::user()]);
            return response()->redirectTo('/');
        }
        // Login falhou, retornar um erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não são válidas.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showLogin(Request $request)
    {
        return view('auth.login');
    }

    public function index()
    {
        return response()->json(
            ["data" => User::all()]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {

        $validatedData = $request->validated();
        $user = $this->userService->create($validatedData);

        event(new WelcomeNotificationEvent($user));

        Auth::login($user);

        return redirect()->route('welcome');

        /* return redirect()
            ->route('users.showLogin')
            ->with(
                'success',
                'Conta criada com sucesso. Faça o login para acessar.'
            ); */
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $followers = $user->followers;
        $following = $user->following;
        $posts = $user->posts;
        $comments = $user->comments;

        return view('users.show', compact('user', 'followers', 'following', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    public function logindAndSignup(Request $request) 
    {
        $user = Auth::user();
        return view('auth.loginAndSignup', compact('user'));;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $validatedData = $request->validated();
        $user = $this->userService->update($user->id, $validatedData);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('posts.index')
            ->with('success', 'User deleted successfully');
    }
}
