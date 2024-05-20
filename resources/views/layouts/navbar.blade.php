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
          <a href="{{ route('users.show', ['user' => Auth::user()]) }}" class="btn btn-outline btn-acciant btn-sm">Perfil</a>
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
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </button>
      </label>
    </form>
    
    
    {{-- <button class="btn btn-ghost btn-circle">
      <div class="indicator">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
        <span class="badge badge-xs badge-primary indicator-item"></span>
      </div>
    </button> --}}

    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="m-1"><button class="btn btn-ghost">
        <div class="indicator">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
          <span class="badge badge-xs badge-primary indicator-item"></span>
        </div>
      </button>
    </div>
    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 max-h-screen overflow-y-auto">
      <li class="fa fa-bell-slash"><a href="{{ route('notificaions.clear') }}" class="btn btn-sm btn-outline btn-primary">limpar</a></li>
      @if (Auth::check())
        @foreach (Auth::user()->notifications as $notification)
          <div class="collapse bg-base-200">
            <input type="radio" name="my-accordion" @if ($loop->first) checked="checked" @endif />
            <div class="collapse-title text-xl font-medium">
              {{ $notification->title }}
            </div>
            <div class="collapse-content">
              <p>{{ $notification->message }}</p>
              </div>
            </div>
          @endforeach
      @endif
  </ul>
    </div>
  </div>
</div>
@if (Auth::check())
  <script>
    const response = await fetch('{{ route('notifications.index') }}', {
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
})
    const notifications = await response.json()
    console.log(notifications);
    const badge = document.querySelector('.indicator-item')
    badge.textContent = notifications.length
  </script>
@endif


{{-- 
  
  @auth
<button class="btn btn-ghost btn-circle">
  <div class="indicator">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
    <span class="badge badge-xs badge-primary indicator-item"></span>
  </div>
</button>
<ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
  @foreach (Auth::user()->notifications as $notification)
    <li>
      <div class="alert alert-{{ $notification->type }}">
        <div>
          <span>{{ $notification->title }}</span>
          <p>{{ $notification->message }}</p>
        </div>
      </div>
    </li>
  @endforeach
</ul>

<script>
  const response = await fetch('{{ route('notifications.index') }}')
  const notifications = await response.json()
  const badge = document.querySelector('.indicator-item')
  badge.textContent = notifications.length
</script>
@endauth

  
  --}}