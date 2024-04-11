@extends('layouts.main')

@section('title', 'editando post')

@section('content')
  <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="artboard-demo p-4 gap-2 min-h-screen">
      @error('title')
      <div class="text-red-500">{{ $message }}</div>
    @enderror
    <label class="input input-bordered flex items-center gap-2">
      <input type="text" class="grow w-60" name="title" autocomplete="off" placeholder="Titulo do post" value="{{ old('title') ?? $post->title }}" />
    </label>
    @error('content')
      <div class="text-red-500">{{ $message }}</div>
    @enderror
    <textarea name="content" class="textarea textarea-secondary" rows="6" cols="50" placeholder="Conteudo do post...">{{ old('content') ?? $post->content }}</textarea>
    <button class="btn btn-primary w-60" type="submit">Update</button>
    <button type="button" class="btn btn-outline btn-error w-32 btn-sm" onclick="my_modal_1.showModal()">Deletar post</button>
    </div>
  </form>
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
@endSection