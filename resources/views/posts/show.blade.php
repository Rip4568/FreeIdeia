@extends('layouts.main')

@section('title', 'Post do(a) ' . $post->user->name)


@section('content')
  <section class="flex flex-col place-content-center place-items-center container content-post p-6 w-full">
    <div class="post card bg-neutral w-1/2 p-6">
      <h1 class="text-5xl text-center">{{ $post->title }}</h1>
      <br>
      <p>Por: <i><a href="#todos-os-posts-deste-usuario">{{ $post->user->name }}</a></i></p>
      <p class="pt-6">{{ $post->content }}</p>
      <br>
      @if (Auth::user()->id == $post->user_id)
        <div class="flex gap-5">
          <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-secondary w-32 btn-sm">Editar</a>
        <button class="btn btn-outline btn-error w-32 btn-sm" onclick="my_modal_1.showModal()">Deletar post</button>
        </div>
      @endif
    </div>
    <section class="comments-form mt-12">
      <form action="{{ route('posts.comments.store', ['post' => $post]) }}" method="post">
        @csrf
        <textarea name="content" required class="textarea textarea-secondary" rows="3" cols="50" placeholder="Adicionar comentario..."></textarea>
        <br>
        <button type="submit" class="btn btn-primary w-full">Comentar</button>
      </form>
      
    </section>
    
  </section>
<section class="comments w-full p-12 rouded">
  <h1>Comentarios:</h1>
  @foreach ($post->comments ?? [] as $comment)
    <div class="bg-neutral p-4">
      <p class="text-sm"><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
      @if (Auth::user()->id == $comment->user_id)
        <form action="{{ route('posts.comments.destroy', ['post' => $post, 'comment' => $comment]) }}" method="post">
        @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-error btn-sm">X</button>
  </form>
      @endif
    </div>
  @endforeach
</section>

  <dialog id="my_modal_1" class="modal">
    <div class="modal-box">
      <h3 class="font-bold text-lg">Deletar <i>{{ $post->title }}</i>?</h3>
      <p class="py-4">Você tem certeza que quer deletar ?</p>
      <div class="modal-action">
        <form method="post" action="{{ route('posts.destroy', ['post' => $post]) }}">
          @csrf
          @method('DELETE')
          {{-- esse formulario vai enviar requisição para deletar o post --}}
          <button type="submit" class="btn btn-error">Sim</button>
        </form>
        <form method="dialog">
          {{-- esse formulario é para fechar o modal sem ação --}}
          <button class="btn btn-success">Não</button>
        </form>
      </div>
    </div>
  </dialog>
@endsection