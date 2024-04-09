@extends('layouts.main')

@section('title', 'Bem vindo ao FreeIdeia')

@section('content')
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
      <div class="max-w-md">
        <h1 class="text-5xl font-bold">Hello there</h1>
        <p class="py-6">Seja muito bem vindo ao meu projeto chamado de: FreeIdeia, seu intuito é apenas divulgar suas opnioes/ideias com todo o publico! sem restrições, banimentos ou censuras, sinta-se livre para expor o que quer!</p>
        <p><a href='{{ route('users.create') }}' class="link link-success">Registre-se</a> para publicar sua Idea</p>
      </div>
    </div>
</div>

@foreach ($posts as $post)
  <p>{{$post->title}}</p>
@endforeach

@endsection