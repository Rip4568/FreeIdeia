@extends('layouts.main')

@section('title', 'Bem vindo ao FreeIdeia')

@section('content')
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
      <div class="max-w-md">
        <h1 class="text-5xl font-bold">Hello there</h1>
        <p class="py-6">Seja muito bem vindo ao meu projeto chamado de: FreeIdeia, seu intuito é apenas divulgar suas opnioes/ideias com todo o publico! sem restrições, banimentos ou censuras, sinta-se livre para expor o que quer!</p>
        @guest()
        <p><a href='{{ route('users.create') }}' class="link link-success">Registre-se</a> para publicar sua Idea</p>
        @endguest
      </div>
    </div>
</div>

<div class="stats shadow w-full flex flex-wrap justify-center items-center" >
  <div class="stat">
    <div class="stat-figure text-secondary">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <div class="stat-title">Posts Acessados</div>
    <div class="stat-value">16</div>
  </div>
  
  <div class="stat">
    <div class="stat-figure text-secondary">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
    </div>
    <div class="stat-title">Usuarios Registrados</div>
    <div class="stat-value">{{ $users_quantity}}</div>
  </div>
  
  <div class="stat">
    <div class="stat-figure text-secondary">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
    </div>
    <div class="stat-title">Posts Criados</div>
    <div class="stat-value">{{ $posts_quantity }}</div>
  </div>
  
</div>

<section class="flex gap-6 w-full justify-center mx-6 mt-6 mb-6">
  @foreach ($posts as $post)
  <div class="card w-96 bg-neutral shadow-xl">
    <div class="card-body">
      <h2 class="card-title">{{$post->title}}</h2>
      <i class="card-title">Por: {{$post->user->name}}</i>
      <div class="card-actions justify-end">
        <button class="btn btn-secondary">Leia o conteudo</button>
      </div>
    </div>
  </div>
@endforeach
</section>

@endsection