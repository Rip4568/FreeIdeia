@extends('layouts.main')

@section('content')
    <div role="tablist" class="tabs tabs-bordered justify-center relative">
        <input type="radio" name="my_tabs_1" role="tab" class="tab" aria-label="Perfil" checked />
        <div role="tabpanel" class="tab-content w-full">
            <div class="flex flex-col items-center justify-center min-h-screen">
                <div class="max-w-md w-full bg-neutral rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold">Perfil de Usuário</h2>
                        <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold mb-2" for="name">
                            Nome
                        </label>
                        <input type="text" value="{{ $user->name }}" class=" input input-bordered" >
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold mb-2" for="email">
                            Email
                        </label>
                        <input type="text" value="{{ $user->email }}" class="input input-bordered" >
                    </div>
                    <button>atulizar</button>
                    <div class="reset-password">
                        <form action="" class="post">
                            <label class="block font-bold mb-2" for="name">
                                Primeira Senha:
                            </label>
                            <input type="text" name="password" id="" class="input input-bordered" placeholder="Nova Senha" required>

                            <label class="block font-bold mb-2" for="name">
                                Repita a Senha:
                            </label>
                            <input type="text" name="password_confirmation" id="" class="input input-bordered" placeholder="Repita a Senha" required>

                            <input type="submit" value="Resetar Senha" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="flex justify-between">
                        <button class="text-red-600 hover:text-red-900" onclick="confirmDelete()">
                            Cancelar Conta
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <input type="radio" name="my_tabs_1" role="tab" class="tab" aria-label="Meus Comentários" />
        <div role="tabpanel" class="tab-content p-10 min-h-screen">Tab content 2</div>

        <input type="radio" name="my_tabs_1" role="tab" class="tab" aria-label="Minhas Ideias" />
        <div role="tabpanel" class="tab-content p-10 min-h-screen">Tab content 3</div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Tem certeza de que deseja cancelar sua conta? Esta ação é irreversível.')) {
                // Lógica para cancelar a conta do usuário
            }
        }
    </script>
@endsection
