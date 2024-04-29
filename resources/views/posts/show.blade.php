@extends('layouts.main')

@section('title', 'Post do(a) ' . $post->user->name)


@section('content')
  <section class="flex flex-col place-content-center place-items-center container content-post p-6 w-full">
    <div class="post card bg-neutral p-6">
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

  <section class="comments w-full p-12 rounded">
    <h1 class="text-3xl font-bold mb-6">Comentários:</h1>
    <div class="comments-list">
       @foreach ($post->comments as $comment)
         <div class="comment bg-neutral p-4 rounded-lg mb-4">
           <div class="comment-header flex justify-between items-center">
             <div class="comment-author">
               <span class="font-semibold">{{ $comment->user->name }}</span>
             </div>
             @if (Auth::user()->id == $comment->user_id)
               <div class="comment-actions flex">
                 <form action="{{ route('posts.comments.destroy', ['post' => $post, 'comment' => $comment]) }}" method="post">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-error btn-sm">Excluir</button>
                 </form>
                 <button class="btn btn-warning btn-sm" onclick="my_modal_{{ $comment->id }}.showModal()" >Editar</button>
               </div>
             @endif
           </div>
           <p class="comment-content">{{ $comment->content }}</p>
         </div>
         <dialog id="my_modal_{{ $comment->id }}" class="modal">
          <div class="modal-box">
            <h3 class="font-bold text-lg gap-5 flex space-between">Editar Comentario 
              <form method="dialog">
                <button type="submit" class="btn btn-primary">Close</button>
              </form>
            </h3>
            <div class="modal-action" style="justify-content: start">
              <form method="post" action="{{ route('posts.comments.update', ['post' => $post, 'comment' => $comment]) }}">
                @csrf
                @method('PUT')
                <textarea name="content" class="textarea textarea-secondary" rows="3" cols="50">{{ $comment->content }}</textarea>
                <br>
                <button type="submit" class="btn btn-primary">Atualizar</button>
              </form>
            </div>
          </div>
        </dialog>
       @endforeach
    </div>
   </section>
  <!-- Dentro de views/page/posts/show.blade.php -->
  @vite(['resources/js/posts/show.js'])
@endsection