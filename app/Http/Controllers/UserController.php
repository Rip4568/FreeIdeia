<?php

namespace App\Http\Controllers;

use App\Events\WelcomeNotificationEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        //
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:3|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);

        //disparar o evneto para dar boas vindas ao novo usuario por meio
        //da tabela de notifications
        event(new WelcomeNotificationEvent($user));

        //Auth::login($user);//utilizar futuramente, facilitar a autenticação do usuário


        return redirect()
            ->route('users.showLogin')
            ->with(
                'success', 
                'Conta criada com sucesso. Faça o login para acessar.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
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
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|required|string|max:255',
            'email' => 'nullable|required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

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
