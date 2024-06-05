@extends('layouts.main')

@section('title', 'Crie seu post!')

@section('content')
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="artboard-demo p-4 gap-2 min-h-screen">
    @error('title')
      <div class="text-red-500">{{ $message }}</div>
    @enderror
    <label class="input input-bordered flex items-center gap-2">
      <input type="text" class="grow" name="title" autocomplete="off" placeholder="Titulo do post" value="{{ old('title') }}" />
    </label>
    @error('content')
      <div class="text-red-500">{{ $message }}</div>
    @enderror
    <textarea name="content" class="textarea textarea-secondary" rows="6" cols="50" placeholder="Conteudo do post...">{{ old('content') }}</textarea>
    @error('user_id')
      <div class="text-red-500">{{ $message }}</div>
    @enderror
    <input type="file" name="banner" class="file-input file-input-bordered file-input-secondary w-full max-w-xs" />
    <button class="btn btn-success w-60" type="submit">Create POST</button>
  </div>
</form>
@endsection