<div class="navbar bg-base-100">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        @guest
        <li><a class="btn btn-outline btn-primary btn-sm" href={{ route('users.showLogin') }}>Login</a></li>
        <li><a class="btn btn-outline btn-secondary btn-sm" href={{ route('users.create') }}>Signup</a></li>
        @endguest
        @auth
        <li>
          <a href="{{ route('posts.index') }}" class="btn btn-outline btn-acciant btn-sm">Ideias</a>
        </li>
        <li>
          <a href="{{ route('users.show', ['user' => $user]) }}" class="btn btn-outline btn-acciant btn-sm">Perfil</a>
        </li>
        <li>
          <a class="btn btn-outline btn-success btn-sm" href="{{ route('posts.create') }}">New Post</a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="post" class="w-full">
            @csrf
            <button type="submit" class="btn btn-outline btn-error btn-sm">Logout</button>
          </form>
        </li>
        @endauth
      </ul>
    </div>
  </div>
  <div class="navbar-center">
    <a class="btn btn-ghost btn-lg text-xl" href="/">FreeIdeia</a>
  </div>
  <div class="navbar-end">
    <form action="{{ route('posts.index') }}" method="get">
    <label class="input input-bordered flex items-center gap-2">
        <input type="text" class="grow" name="search" required placeholder="Search" value="{{ request('search') }}" />
        <button class="btn btn-ghost" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m 2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </button>
      </label>
    </form>

    
    @if (Auth::check())
      @livewire('notification-livewire')
    @endif
    {{-- <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 max-h-screen overflow-y-auto notifications">
      <li class="fa fa-bell-slash"><a href="{{ route('notificaions.clear') }}" class="btn btn-sm btn-outline btn-primary">limpar tudo</a></li>
    </ul> --}}
    </div>
  </div>
</div>

@if (Auth::check())
  <script>
    document.addEventListener('DOMContentLoaded', (documentEvent) => {
      const logo = document.getElementById('logo');
      logo.addEventListener('click', async (event) => {
        event.preventDefault();
        const response = await window.axios.get('{{ route('notifications.welcome.test') }}');
        console.log(response);
      });
    })
  </script>
@endif