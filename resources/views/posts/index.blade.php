@extends('layouts.main')


@section('content')
<section class="flex gap-6 wrap flex-wrap mx-6 mt-6 mb-6">
  @foreach ($posts as $post)
    <div class="card w-96 bg-neutral shadow-xl">
      <div class="card-body">
        <h2 class="card-title">{{$post->title}}</h2>
        <i class="card-title">Por: {{$post->user->name}}</i>
        <div class="card-actions justify-end">
          <a class="btn btn-secondary" href="{{ route('posts.show', ['post'=>$post]) }}">Leia o conteudo</a>
        </div>
      </div>
    </div>
  @endforeach
</section>
@endsection