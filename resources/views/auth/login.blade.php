@extends('layouts.main')

@section('content')
<form action="{{ route('users.login') }}" method="POST">
  @csrf
  <div class="artboard-demo p-4 gap-2 min-h-screen">
    @error('email')
    <div class="text-red-500">{{ $message }}</div>
    @enderror
    <label class="input input-bordered flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" /><path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" /></svg>
      <input type="text" class="grow" name="email" placeholder="Email" value="{{ old('email') }}" />
    </label>
    @error('password')
    <div class="text-red-500">{{ $message }}</div>
    @enderror
    <label class="input input-bordered flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z" clip-rule="evenodd" /></svg>
      <input type="password" class="grow" name="password" placeholder="Sua senha" />
    </label>
    <div class="flex flex-col">
      <div class="form-control w-52">
        <label class="cursor-pointer label">
          <span class="label-text">Lembrar-me</span> 
          <input type="checkbox" name="remember-me" class="toggle toggle-primary" checked />
        </label>
      </div>
    </div>
    <button class="btn btn-secondary w-60 rounded-full" type="submit">Login</button>
    <p>Esqueceu sua senha? <a href="#em-construcao" class="link link-success">recupere-a</a></p>
    <p>Não tem uma conta ainda? <a href="{{ route('users.create') }}" class="link link-success">inscreva-se</a></p>
  </div>
</form>
@endsection