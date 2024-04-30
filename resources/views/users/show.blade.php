@extends('layouts.main')

@section('content')
  <section class="flex flex-col place-content-center place-items-center container content-post p-6 w-full">
    <div class="post card bg-neutral p-6">
      <h1 class="text-5xl text-center">{{ $user->name }}</h1>
      <br>
      <p>Por: <i><a href="#todos-os-posts-deste-usuario">{{ $user->name }}</a></i></p>
      <p class="pt-6">{{ $user->email }}</p>
      <br>
    </div>
  </section>
@endsection